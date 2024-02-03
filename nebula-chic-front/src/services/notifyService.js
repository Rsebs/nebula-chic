import { Notify } from "quasar";

export function onShowNotify(sMessage) {
  return Notify.create({
    message: sMessage,
    position: "top",
    type: "positive",
  });
}
