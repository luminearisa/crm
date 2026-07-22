CRM Enterprise - Struktur Direktori
=====================================

/workspace
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Client.php
│   │   ├── Lead.php
│   │   ├── Activity.php
│   │   ├── Service.php
│   │   ├── Proposal.php
│   │   ├── ProposalItem.php
│   │   ├── Invoice.php
│   │   ├── Task.php
│   │   ├── Event.php
│   │   ├── Ticket.php
│   │   ├── Document.php
│   │   ├── Expense.php
│   │   └── Setting.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── LogoutController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ClientController.php
│   │   │   ├── LeadController.php
│   │   │   ├── ActivityController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── ProposalController.php
│   │   │   ├── InvoiceController.php
│   │   │   ├── TaskController.php
│   │   │   ├── EventController.php
│   │   │   ├── TicketController.php
│   │   │   ├── DocumentController.php
│   │   │   ├── ExpenseController.php
│   │   │   ├── ReportController.php
│   │   │   └── SettingController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   ├── Policies/
│   │   ├── ClientPolicy.php
│   │   ├── LeadPolicy.php
│   │   ├── ProposalPolicy.php
│   │   └── InvoicePolicy.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_clients_table.php
│   │   ├── 2024_01_01_000003_create_leads_table.php
│   │   ├── 2024_01_01_000004_create_activities_table.php
│   │   ├── 2024_01_01_000005_create_services_table.php
│   │   ├── 2024_01_01_000006_create_proposals_table.php
│   │   ├── 2024_01_01_000007_create_proposal_items_table.php
│   │   ├── 2024_01_01_000008_create_invoices_table.php
│   │   ├── 2024_01_01_000009_create_tasks_table.php
│   │   ├── 2024_01_01_000010_create_events_table.php
│   │   ├── 2024_01_01_000011_create_tickets_table.php
│   │   ├── 2024_01_01_000012_create_documents_table.php
│   │   ├── 2024_01_01_000013_create_expenses_table.php
│   │   └── 2024_01_01_000014_create_settings_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── components/
│   │   │   ├── layout/
│   │   │   │   ├── app.blade.php
│   │   │   │   ├── sidebar.blade.php
│   │   │   │   └── header.blade.php
│   │   │   └── ui/
│   │   │       ├── card.blade.php
│   │   │       ├── button.blade.php
│   │   │       ├── input.blade.php
│   │   │       ├── select.blade.php
│   │   │       ├── modal.blade.php
│   │   │       └── badge.blade.php
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   ├── clients/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── leads/
│   │   │   ├── index.blade.php (Kanban Board)
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── activities/
│   │   │   └── _modal_form.blade.php
│   │   ├── services/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── proposals/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   ├── invoices/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php (Digital Invoice HTML)
│   │   │   └── edit.blade.php
│   │   ├── tasks/
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── events/
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── tickets/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── show.blade.php
│   │   ├── documents/
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── expenses/
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── reports/
│   │   │   └── index.blade.php (Leaderboard)
│   │   ├── settings/
│   │   │   └── index.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   ├── js/
│   │   └── app.js
│   └── css/
│       └── app.css
├── public/
│   ├── uploads/
│   │   ├── documents/
│   │   └── invoices/
│   └── index.php
├── routes/
│   └── web.php
├── config/
│   └── app.php
└── .env
