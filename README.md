# Laravel Actor Submission App

### Overview
A small Laravel application that allows users to submit information about an actor.  
The app validates input, sends a description to an AI service (OpenAI/Gemini), parses structured data, saves it in the database, and displays submissions.

---

### Architecture
| Layer             | Responsibility                                        |
|-------------------|-------------------------------------------------------|
| **DTO**           | Structured data transfer between layers               |
| **Repository**    | DB interaction                                        |
| **Service**       | AI driver logic (`OpenAiService`, `GeminiService`)    |
| **Client**        | Handles API requests (`OpenAiClient`, `GeminiClient`) |
| **Factory**       | Creates service instance based on configured driver   |
| **PromptBuilder** | Builds AI prompt from template                        |
| **Exceptions**    | Custom domain-specific error types                    |

AI drivers are bound through the container in `AppServiceProvider`.  
The active driver is selected via `config('ai.default')` or `.env` → `AI_DRIVER=openai`.

---

### Endpoints
#### Web
| Method | URL       | Description         |
|--------|-----------|---------------------|
| GET    | `/`       | Form page           |
| GET    | `/actors` | List of submissions |

#### API
| Method | URL                             | Description                        |
|--------|---------------------------------|------------------------------------|
| POST   | `/api/actors`                   | Creates new actor record (uses AI) |
| GET    | `/api/actors/prompt-validation` | Returns raw AI prompt template     |
