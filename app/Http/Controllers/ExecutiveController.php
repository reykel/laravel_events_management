<?php

namespace App\Http\Controllers;

use App\Exports\ExecutiveExport;
use App\Http\Requests\StoreExecutiveRequest;
use App\Http\Requests\UpdateExecutiveRequest;
use App\Http\Resources\ExecutiveResource;
use App\Interfaces\ExecutiveRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExecutiveController extends Controller
{
    protected ExecutiveRepositoryInterface $executiveRepository;

    public function __construct(ExecutiveRepositoryInterface $executiveRepository)
    {
        $this->executiveRepository = $executiveRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Executive/Form', [
            'list' => ExecutiveResource::arrayCollection($this->executiveRepository->getAllExecutives())
        ]);
    }

    public function list(Request $request): \Inertia\Response
    {
        $user = Auth::user();
        if($user->role->name !== 'Admin'){
            return redirect(route('driver_list'));
    }
        return Inertia::render('Executive/Index', [
            'list' => ExecutiveResource::arrayCollection($this->executiveRepository->getAllExecutives())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExecutiveRequest $request
     * @return JsonResponse
     */
    public function store(StoreExecutiveRequest $request)
    {
        $res = $this->verifyCaptcha($request->captcha_token);
        $executive =  $this->executiveRepository->createExecutive($request);

        $message = 'Executive was created';
        if ($request->wantsJson())
            return response()->json([
                'message' => $message,
                'data' => new ExecutiveResource($executive)
            ], 200);

        if ($executive) {
            $email_result = $this->executiveRepository->sendEmail($executive);
            if ($email_result == 'ok')
                return Inertia::render('Executive/RegisterSuccess')
                    ->with('message', [
                        'text' => 'Thank you for your registration. We sent you an email with your provided data.',
                    ]);
            else {
                return redirect()->back()->with('message', [
                    'text' => $email_result,
                ]);
            }
        }
        return redirect()->back()->with('message', [
            'text' => 'There was a problem with the registration.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExecutiveRequest $request
     * @param $id
     * @return \Inertia\Response
     */
    public function edit(Request $request, $id): \Inertia\Response
    {
        $executive =  $this->executiveRepository->getExecutiveById($id);
        $executive = new ExecutiveResource($executive);
        return Inertia::render('Executive/Edit', [
            'executive' => $executive
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function success(): \Inertia\Response
    {
        return Inertia::render('Executive/RegisterSuccess', [
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Inertia\Response
     */
    public function show($id): \Inertia\Response
    {
        $executive =  $this->executiveRepository->getExecutiveById($id);

        return Inertia::render('Executive/Show', [
            'executive' => $executive
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExecutiveRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update($id, UpdateExecutiveRequest $request): RedirectResponse
    {
        $success =  $this->executiveRepository->updateExecutive($id, $request);
        return redirect()->route('executives_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $success =  $this->executiveRepository->deleteExecutive($id);

        if($success){
            return redirect()->back()->with('message', [
                'text' => 'Operation has fail',
            ]);
        }
        return redirect()->back();
    }

    /**
     *
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new ExecutiveExport, 'assistants.xlsx');
    }

    /**
     * @param $value
     * @return bool
     */
    public function verifyCaptcha($value): bool
    {
        $endpoint = config('services.google_recaptcha');

        $response = Http::asForm()->post($endpoint['url'], [
            'secret' => $endpoint['secret_key'],
            'response' => $value,
        ])->json();

        if(  $response['success'] && $response['score'] > 0.5) {
            return true;
        }

        return false;
    }

    /**
     * @param $recaptcha
     * @return mixed
     */
    public function captchaVerify($recaptcha){
        $endpoint = config('services.google_recaptcha');
        $data = http_build_query([
            'secret' => $endpoint['secret_key'],
            'response' => $recaptcha
        ]);


        $options = [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],
            CURLINFO_HEADER_OUT => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPPROXYTUNNEL => true
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);



        $data = json_decode($response);

        return $data->success;
    }


}
