# 🎓 Tont-Project
### *Empowering the Future of Education: A Holistic School Management & Community Ecosystem*

![Digitopia 2025](https://img.shields.io/badge/Award-4th%20Place%20Egypt%20%7C%20Digitopia%202025-gold?style=for-the-badge&logo=award)
![License](https://img.shields.io/badge/License-Open%20Source-blue?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker)

---

## 📖 Project Narrative

**Tont-Project** is more than just a school management system; it is a comprehensive educational ecosystem designed to bridge the gap between administration, pedagogy, and student well-being. Developed with the vision of modernizing the educational experience in Egypt and beyond, Tont provides a unified platform for management, community engagement, and AI-driven insights.

The journey began in **September 2025** by the **Code-Hatsu** team. After securing **4th place in Egypt** at the prestigious **Digitopia 2025** competition (organized by the Ministry of Communications and Information Technology), we have transitioned the project to **Open Source**. We believe that by opening our doors to the global developer community, we can continue to evolve and impact the lives of students and educators everywhere.

---

## 👥 Meet the 'Code-Hatsu' Team

Behind Tont-Project is a dedicated group of innovators committed to educational excellence:

| Name | Role | Expertise |
| :--- | :--- | :--- |
| **Mohammed Saleh** | 🎖️ Team Leader & Full Stack Architect | PHP, MySQL, System Design |
| **Halla Osama** | 🎨 UI/UX Designer | User Research, Interface Design, Branding |
| **Abdelrahman Rashed** | 💻 Front End Developer | UI Implementation, Interactive Components |

---

## ✨ Feature Showcase

Tont-Project is divided into modular components to ensure a seamless experience for all stakeholders.

### 🏛️ Core Management Module
*   **Unified Authentication:** Secure login and account activation for all user types.
*   **Comprehensive Admin Panel:** Powerful SFCRUD operations for managing the entire system.
*   **Stakeholder Portals:** Dedicated dashboards for Students, Teachers, and Parents.
*   **Academic Tracking:** Manage Grades, Exams, and generate detailed Attendance and Performance Reports.
*   **Communication Hub:** School-wide announcements and notifications.

### 🚀 Student Productivity & Growth
*   **Dashboard:** An easy-to-use, personalized landing page for every student.
*   **Learning Tools:** Notebook with editor, Mistakes Notebook for reflection, and To-Do lists.
*   **Self-Management:** Integrated Habit Tracker and Timetable management.
*   **Resource Center:** Access to Materials, static Streams, and Certificates.

### 🧠 Psychological & Path-Finding Tests
*   **VARK Test:** Identify student learning styles (Visual, Aural, Read/Write, Kinesthetic).
*   **Path-Finder Test:** Specialized assessment to help students discover their career and academic paths.
*   **Motivational Support:** Daily quotes to keep students inspired.

### 🌐 Community & Intelligence
*   **Education Community:** A social space for students and teachers to interact and share knowledge.
*   **Leaderboard:** Gamified ranking system to encourage healthy competition.
*   **AI Integration:** Advanced features powered by Google AI Studio for personalized assistance.

---

## 🛠️ Technical Deep Dive

### The Stack
Tont-Project is built on a robust and scalable stack designed for reliability:
*   **Backend:** PHP (Modular OOP architecture)
*   **Database:** MySQL (Relational schema for complex educational data)
*   **Frontend:** HTML5, CSS3, JavaScript (Clean, responsive UI)
*   **Containerization:** Docker & Docker Compose for consistent development and deployment.

### 🤖 AI Integration
Tont leverages the power of Large Language Models via the **Google AI Studio API**. By integrating Gemini models, we provide students and teachers with intelligent assistance directly within the platform.

---

## 🚀 Deployment Guide

We utilize Docker to ensure that the project runs seamlessly across different environments.

### Prerequisites
*   [Docker](https://www.docker.com/get-started)
*   [Docker Compose](https://docs.docker.com/compose/install/)

### Local Setup
1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/your-username/tont-project.git
    cd tont-project
    ```
2.  **Initialize Containers:**
    Navigate to the setup directory and start the services:
    ```bash
    cd docker_setup
    docker compose up --build -d
    ```
    *Note: The database is automatically initialized from `init/db.sql` on the first run.*

3.  **Access the Application:**
    *   **Website:** [http://localhost](http://localhost)
    *   **Database Manager (phpMyAdmin):** [http://localhost:8081](http://localhost:8081)
    *   **Demo Data Setup:** [http://localhost/demo_setup/index.php](http://localhost/demo_setup/index.php) (Use this to populate your local database with test data).

### ⚙️ Production & AI Configuration
*   **Environment Variables:** Edit the `configs.ini` file to match your production database credentials and host settings.
*   **AI Feature Activation:**
    1.  Obtain an API Key from [Google AI Studio](https://aistudio.google.com/).
    2.  Open `api/ai.php`.
    3.  Replace the placeholder `$apiKey` with your actual key.

---

## 🌐 Live Demo Access

Experience Tont-Project live through our demo environment:

| Portal | URL | Credentials (User/Pass) |
| :--- | :--- | :--- |
| **Home Page** | [tont.ct.ws](https://tont.ct.ws/) | N/A |
| **Admin Panel** | [Admin Login](https://tont.ct.ws/new/admin/login.php) | `sudo` / `password` |
| **Student Portal** | [Student Login](https://tont.ct.ws/login/index.php?demo=s) | Auto-login via Demo Link |
| **Parent Portal** | [Parent Login](https://tont.ct.ws/login/index.php?demo=p) | Auto-login via Demo Link |
| **Teacher Portal** | [Teacher Login](https://tont.ct.ws/login/index.php?demo=t) | Auto-login via Demo Link |

---

## 🗄️ Database Architecture

Tont-Project uses a relational MySQL database with a highly normalized schema to ensure data integrity and scalability.

### Core Data Domains
*   **User Management:** Centralized `users` table linked via `role_id` and `ref_id` to specific entities (`students`, `teachers`, `parents`, `admins`). Supports 2FA and secure session tokens.
*   **Academic Lifecycle:** Tracks everything from `schools` and `grades` to `subjects`, `exams`, `marks`, and `absence` records.
*   **Student Wellbeing:** Stores data for `habit_tracker`, `notebooks`, and results from psychological assessments (`vark`, `path-finder`).
*   **Community Hub:** Manages social interactions through `posts`, `comments`, `post_likes`, `tags`, and a notification system.

---

## 🏗️ System Design & Workflow

### Architecture Overview
Tont-Project follows a **Modular Monolith** architecture:
*   **Separation of Concerns:** Core logic resides in `includes/`, while specific features are isolated in the `apps/` directory.
*   **Evolutionary OOP:** The project is transitioning to a modern OOP structure (found in the `new/` directory) for better maintainability and testability.
*   **Containerized Environment:** Fully orchestrated with Docker, separating the Web Server (Apache/PHP-FPM) from the Database (MySQL) and Management tools (phpMyAdmin).

### Primary User Flow
1.  **Onboarding:** New users register via `get_account/`, which validates their credentials against pre-existing school records.
2.  **Authentication:** Secure login with optional 2FA.
3.  **Personalized Dashboard:** Upon entry, users are routed to their role-specific portal (Student, Teacher, or Parent).
4.  **Engagement:** Students use productivity tools, Teachers manage academic data, and Parents monitor progress.
5.  **Community Interaction:** All users can engage in the educational community for knowledge exchange.

---

## 💼 Business Use Case & Setup

### For Educational Institutions
Tont-Project is designed to be the digital backbone of a school. It reduces administrative overhead by:
*   Automating attendance and grading reports.
*   Providing a direct, secure communication channel with parents.
*   Enhancing student performance through AI-driven insights and productivity tools.

### Setup for Businesses/Schools
1.  **Infrastructure:** Deploy the Docker containers on a VPS or on-premise server.
2.  **Data Initialization:** Use the `init/db.sql` to set up the schema and the `demo_setup/` utility to import existing student/staff lists.
3.  **Branding:** Customize the `aboutus/` and `assets/` to reflect the school's identity.
4.  **AI Activation:** Link your Google AI Studio API key to enable the intelligent assistant features.

---

## 💪 Strong Points

*   **Award-Winning Pedagogy:** Built on concepts that won 4th place at Digitopia 2025, ensuring it meets real-world educational needs.
*   **AI-First Ecosystem:** Deep integration with Gemini for personalized student support, moving beyond simple automation.
*   **Holistic Approach:** Combines academic management with psychological tools (VARK) and productivity tracking (Habit Tracker) in a single platform.
*   **Open Source & Extensible:** A modular codebase that developers can easily adapt for different educational systems.
*   **High Security:** Features like 2FA, prepared PDO statements, and secure token-based authentication.

---

## 📂 Project Structure

Tont-Project follows a modular architecture, separating core logic, user-facing applications, and administrative tools.

| Directory | Description |
| :--- | :--- |
| `aboutus/` | Project background and mission details. |
| `announcement/` | School-wide announcement system with media support. |
| `api/` | External API integrations (e.g., Google AI Studio/Gemini). |
| `apps/` | **Core Feature Hub:** Contains VARK tests, Habit Tracker, Notebook, Tasks, and more. |
| `assets/` | Global static assets: CSS, JS (Assistant, Login), and Fonts (FontAwesome). |
| `community/` | Social platform for student-teacher interaction and knowledge sharing. |
| `docker_setup/` | Containerization configuration (Docker Compose, MySQL, and Apache/PHP). |
| `get_account/` | Logic for secure account creation and activation. |
| `includes/` | Core backend utilities: Database connection, session management, and validation. |
| `init/` | Database initialization scripts (`db.sql`). |
| `login/` | Secure authentication system for all user roles. |
| `marks/` | Comprehensive academic reporting system for students, parents, and teachers. |
| `new/` | Modern OOP-based architecture, including the enhanced Admin Panel. |
| `settings/` | User profile management, security settings, and avatar uploads. |
| `templates/` | Reusable UI components (Navigation, Footers, Sidebars). |

---

## 🤝 Contributing

As an open-source project, we welcome contributions! Whether you're fixing bugs, adding new features, or improving documentation, your help is appreciated. Please feel free to fork the repository and submit a Pull Request.

---

*Presented by the **Code-Hatsu** Team. Digitopia 2025.*
