interface User {
  id: number
  email: string
}

interface Plan {
  id: number
  title: number
  comment: string
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
