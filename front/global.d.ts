interface User {
  id: number
  email: string
}

interface Plan {
  id?: number
  title: string
  comment: string
  date: string
  time?: string
  is_finished: boolean
  penalty?: number
}

interface Meta {
  current_page: number
  last_page: number
}

interface ApiResponse<T> {
  data: T
  meta: Meta
}

type PlanResponse = ApiResponse<Plan[]>
