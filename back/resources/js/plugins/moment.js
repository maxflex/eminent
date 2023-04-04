import moment from "moment"
import "moment/dist/locale/ru"

export default function (app) {
  app.config.globalProperties.$moment = moment
}
