
### Api Endpoints
- **POST** /register register a user
- **POST** /login user login
- **GET** /jobs get list of all jobs
- **GET** /jobs/{jobId} get job by id
- **POST** /jobs/user/{userId} create jobs **Note: An header request X-Header-UserId must be passed**
- **PUT** /jobs/{jobId} update job **Note: An header request X-Header-UserId must be passed**
- **DELETE** /jobs/{jobId} delete job **Note: An header request X-Header-UserId must be passed**
- **POST** /job-application apply for job
- **GET** /job-application/{jobId}/jobs get job applications by job id **Note: An header request X-Header-UserId must be passed**
- **GET** /job-application/{jobApplicationId} get job applications by id get job by id **Note: An header request X-Header-UserId must be passed**

