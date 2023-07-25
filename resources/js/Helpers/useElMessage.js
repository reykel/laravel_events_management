import { ref } from "vue";
import { ElMessage } from "element-plus";

export default function useElMessage() {
  const showElMessage = (props) => {
    const newVal = props && props.flash;
    if (newVal && newVal.success) {
      ElMessage({
        showClose: true,
        message: newVal.success,
        type: "success",
      });
    }
    if (newVal && newVal.error) {
      ElMessage({
        showClose: true,
        message: newVal.error,
        type: "error",
      });
    }
    if (newVal && (newVal.success || newVal.error)) {
      delete newVal.success;
      delete newVal.error;
    }
  };
  return { showElMessage };
}