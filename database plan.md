# **Phase 1 Step 2: Database Design & Setup (Execution)**

In this step, we’ll create the **MySQL database** for the Airlines Reservation System using **PHPMyAdmin** (via XAMPP). Below is the step-by-step execution:

---

## **1. Open PHPMyAdmin**
1. Start **XAMPP** and run **Apache + MySQL**.
2. Go to:  
   → `http://localhost/phpmyadmin`

---

## **2. Create a New Database**
1. Click **"New"** (left sidebar).
2. Enter database name: `airlines_db`  
3. Click **"Create"**.

---

## **3. Create Tables**
We need **3 main tables**:
1. `users` (for user accounts)
2. `flights` (for flight details)
3. `bookings` (for user bookings)

### **Table 1: `users` (Stores user data)**
| Column       | Type          | Description |
|--------------|---------------|-------------|
| `id`         | INT (Primary, Auto-Increment) | Unique user ID |
| `name`       | VARCHAR(100)  | User's full name |
| `email`      | VARCHAR(100)  | User's email (unique) |
| `password`   | VARCHAR(255)  | Hashed password |
| `role`       | ENUM('user', 'admin') | User role (default: 'user') |

**SQL to create `users`:**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);
```

---

### **Table 2: `flights` (Stores flight details)**
| Column       | Type          | Description |
|--------------|---------------|-------------|
| `id`         | INT (Primary, Auto-Increment) | Flight ID |
| `flight_no`  | VARCHAR(20)   | Flight number (e.g., "AI101") |
| `departure`  | VARCHAR(100)  | Departure city |
| `arrival`    | VARCHAR(100)  | Arrival city |
| `date`       | DATETIME      | Departure date & time |
| `seats`      | INT           | Available seats |
| `price`      | DECIMAL(10,2) | Ticket price |

**SQL to create `flights`:**
```sql
CREATE TABLE flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flight_no VARCHAR(20) NOT NULL,
    departure VARCHAR(100) NOT NULL,
    arrival VARCHAR(100) NOT NULL,
    date DATETIME NOT NULL,
    seats INT NOT NULL,
    price DECIMAL(10,2) NOT NULL
);
```

---

### **Table 3: `bookings` (Stores user bookings)**
| Column       | Type          | Description |
|--------------|---------------|-------------|
| `id`         | INT (Primary, Auto-Increment) | Booking ID |
| `user_id`    | INT           | Foreign key (links to `users.id`) |
| `flight_id`  | INT           | Foreign key (links to `flights.id`) |
| `seat_no`    | VARCHAR(10)   | Seat number (e.g., "A12") |
| `status`     | ENUM('booked', 'cancelled') | Booking status |
| `payment`    | DECIMAL(10,2) | Amount paid |

**SQL to create `bookings`:**
```sql
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    flight_id INT NOT NULL,
    seat_no VARCHAR(10) NOT NULL,
    status ENUM('booked', 'cancelled') DEFAULT 'booked',
    payment DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (flight_id) REFERENCES flights(id)
);
```

---

## **4. Insert Sample Data (Optional)**
### **Add an Admin User**
```sql
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@airlines.com', '$2y$10$exampleHash', 'admin');
```
*(Use `password_hash('admin123', PASSWORD_BCRYPT)` in PHP to generate a real hash.)*

### **Add Sample Flights**
```sql
INSERT INTO flights (flight_no, departure, arrival, date, seats, price) 
VALUES 
    ('AI101', 'New York', 'London', '2025-04-01 08:00:00', 150, 299.99),
    ('UA202', 'Chicago', 'Los Angeles', '2025-04-02 10:30:00', 200, 199.99);
```

---

## **5. Verify Tables**
Check if tables are created successfully:
- Go to `airlines_db` in PHPMyAdmin.
- You should see:
  - `users`
  - `flights`
  - `bookings`

---

## **6. Next Steps**
- **Phase 2 (Backend):** Start coding PHP for:
  - User registration/login (`register.php`, `login.php`).
  - Flight search (`search.php`).
- **Phase 3 (Frontend):** Design HTML/CSS for the UI.

Would you like me to provide the PHP code for user authentication next? 🚀