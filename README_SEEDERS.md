# CRM Enterprise - Database Seeders

## 📋 Ringkasan Seeder yang Telah Dibuat

Berikut adalah 13 file seeder lengkap yang telah dibuat untuk mengisi database dengan data dummy yang realistis:

### 1. **UserSeeder** (`UserSeeder.php`)
- **Admin**: 1 user (admin@crm.com)
- **Manager**: 2 users (manager@crm.com, operations@crm.com)
- **Agent**: 5 users (john, jane, bob, alice, charlie @crm.com)
- **Password default**: `password123`

### 2. **SettingSeeder** (`SettingSeeder.php`)
- Nama perusahaan, alamat, kontak
- Default tax rate (11%)
- Currency symbol (Rp)
- Payment terms (14 hari)
- Minimum payment percentage (30%)
- Timezone, date format, system version

### 3. **ServiceSeeder** (`ServiceSeeder.php`)
- 10 layanan IT lengkap:
  - Web Development (Rp 50jt)
  - Mobile App Development (Rp 75jt)
  - UI/UX Design (Rp 15jt)
  - Cloud Services (Rp 25jt)
  - Digital Marketing (Rp 10jt)
  - IT Consulting (Rp 5jt)
  - Security Audit (Rp 30jt)
  - Data Analytics (Rp 40jt)
  - ERP Implementation (Rp 100jt)
  - Training & Workshop (Rp 7.5jt)
  - Maintenance & Support (Rp 5jt)

### 4. **ClientSeeder** (`ClientSeeder.php`)
- 8 perusahaan klien dari berbagai kota di Indonesia
- Setiap klien memiliki: company_name, contact_person, email, phone, address
- PIC (user_id) ditugaskan secara acak ke agent

### 5. **LeadSeeder** (`LeadSeeder.php`)
- 10 leads dengan berbagai status:
  - new, contacted, proposal, negotiation, won, lost
- Expected value bervariasi dari Rp 15jt - Rp 180jt
- Terkait dengan client dan assigned to agent

### 6. **ActivitySeeder** (`ActivitySeeder.php`)
- 10 activities dengan type: call, email, meeting
- Notes deskriptif untuk setiap interaksi
- Activity date dalam 30 hari terakhir

### 7. **ProposalSeeder** (`ProposalSeeder.php`)
- 5 proposals dengan status: draft, sent, accepted, pending, rejected
- Setiap proposal memiliki 2-4 items (services)
- Total amount dihitung otomatis berdasarkan qty × price

### 8. **InvoiceSeeder** (`InvoiceSeeder.php`)
- Invoice untuk proposals yang accepted dan pending
- Status: unpaid, partial, paid
- Minimum payment = 30% dari total amount
- Format nomor invoice: INV-YYYYMMDD-XXXX

### 9. **TaskSeeder** (`TaskSeeder.php`)
- 8 tasks dengan status: pending, in_progress, completed
- Due date dalam 1-14 hari ke depan
- Deskripsi tugas yang detail

### 10. **EventSeeder** (`EventSeeder.php`)
- 8 events kalender
- Start time dan end time yang realistis
- Location beragam (kantor klien, online, hotel, dll)

### 11. **TicketSeeder** (`TicketSeeder.php`)
- 8 support tickets
- Status: open, progress, closed
- Priority: low, medium, high
- Subject dan description yang relevan

### 12. **DocumentSeeder** (`DocumentSeeder.php`)
- 8 dokumen dengan type: contract, nda, other
- File path simulasi untuk uploaded documents
- Terkait dengan clients

### 13. **ExpenseSeeder** (`ExpenseSeeder.php`)
- 8 expense records
- Categories: transportation, accommodation, meals, entertainment, office_supplies, others
- Amount realistis untuk setiap kategori
- Date dalam 30 hari terakhir

## 🔧 Cara Menjalankan Seeders

### Opsi 1: Jalankan Semua Seeders Sekaligus
```bash
php artisan db:seed
```

### Opsi 2: Jalankan Seeder Tertentu
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ClientSeeder
php artisan db:seed --class=LeadSeeder
# dst...
```

### Opsi 3: Fresh Migration + Seed (Reset Database)
```bash
php artisan migrate:fresh --seed
```

## 📊 Urutan Eksekusi Seeder

Urutan seeder sudah diatur di `DatabaseSeeder.php` untuk memastikan integritas foreign key:

1. UserSeeder (users harus ada dulu)
2. SettingSeeder (independent)
3. ServiceSeeder (independent)
4. ClientSeeder (butuh users untuk user_id/PIC)
5. LeadSeeder (butuh clients dan users)
6. ActivitySeeder (butuh leads dan users)
7. ProposalSeeder (butuh leads dan services)
8. InvoiceSeeder (butuh proposals)
9. TaskSeeder (butuh users)
10. EventSeeder (butuh users)
11. TicketSeeder (butuh clients)
12. DocumentSeeder (butuh clients)
13. ExpenseSeeder (butuh users)

## 👤 Login Credentials

Setelah seeding, Anda dapat login dengan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@crm.com | password123 |
| Manager | manager@crm.com | password123 |
| Manager | operations@crm.com | password123 |
| Agent | john@crm.com | password123 |
| Agent | jane@crm.com | password123 |
| Agent | bob@crm.com | password123 |
| Agent | alice@crm.com | password123 |
| Agent | charlie@crm.com | password123 |

## 📈 Statistik Data Dummy

Setelah semua seeders dijalankan, database akan berisi:

- **Users**: 8 (1 admin, 2 managers, 5 agents)
- **Clients**: 8 companies
- **Leads**: 10 opportunities
- **Activities**: 10 interactions
- **Services**: 10 products/services
- **Proposals**: 5 quotations
- **Proposal Items**: ~15-20 items
- **Invoices**: ~5-7 invoices
- **Tasks**: 8 tasks
- **Events**: 8 calendar events
- **Tickets**: 8 support tickets
- **Documents**: 8 documents
- **Expenses**: 8 expense records
- **Settings**: 11 configuration values

**Total Records**: ~100+ records siap untuk demo dan testing!

## ⚠️ Catatan Penting

1. **Database SQLite**: Pastikan file `database/database.sqlite` sudah dibuat sebelum menjalankan seeders.

2. **Migrations**: Jalankan migrations terlebih dahulu sebelum seeding:
   ```bash
   php artisan migrate
   ```

3. **Password Hashing**: Semua password di-hash menggunakan bcrypt dengan cost factor 12.

4. **Random Assignment**: Beberapa data (seperti PIC client, assigned lead) menggunakan random assignment untuk variasi data.

5. **Data Realistis**: Semua data dummy menggunakan konteks bisnis Indonesia (nama perusahaan, mata uang Rupiah, lokasi kota-kota Indonesia).

## 🎯 Fitur Data Dummy

- ✅ Multi-role users (admin, manager, agent)
- ✅ Pipeline leads dengan semua status
- ✅ Proposal dengan multiple items
- ✅ Invoice dengan minimum payment (30%)
- ✅ Activities timeline
- ✅ Calendar events
- ✅ Support tickets dengan priority
- ✅ Expense tracking per kategori
- ✅ System settings lengkap

Selamat menggunakan CRM Enterprise! 🚀
