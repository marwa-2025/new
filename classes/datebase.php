<?php

class Database {
    public $pdo;

    // Constructor to initialize the database connection
    public function __construct($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

     //Method to add data
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
    




    // Method to get data
    public function select($table, $conditions = [], $columns = "*") {
        $sql = "SELECT $columns FROM $table";
        if (!empty($conditions)) {
            $conditionClauses = [];
            foreach ($conditions as $key => $value) {
                $conditionClauses[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $conditionClauses);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to update data
    public function update($table, $data, $conditions) {
        $setClauses = [];
        foreach ($data as $key => $value) {
            $setClauses[] = "$key = :$key";
        }
        $conditionClauses = [];
        foreach ($conditions as $key => $value) {
            $conditionClauses[] = "$key = :$key";
        }
        $sql = "UPDATE $table SET " . implode(", ", $setClauses) . " WHERE " . implode(" AND ", $conditionClauses);
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_merge($data, $conditions));
    }

    // Method to delete data
    public function delete($table, $conditions) {
        $conditionClauses = [];
        foreach ($conditions as $key => $value) {
            $conditionClauses[] = "$key = :$key";
        }
        $sql = "DELETE FROM $table WHERE " . implode(" AND ", $conditionClauses);
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($conditions);
    }
}

// الوراثة من كلاس Database
class User extends Database {

   

    // تسجيل مستخدم جديد
    public function register($data) {
        // تشفير كلمة المرور
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        // إضافة بيانات المستخدم للجدول
        return $this->insert('users', $data);
    }



    // تسجيل الدخول
    public function login($email, $password) {
        // جلب بيانات المستخدم بناءً على البريد الإلكتروني
        $user = $this->select('users', ['email' => $email]);

         //التحقق من وجود المستخدم
        if (!empty($user)) {
            $user = $user[0]; // الحصول على أول نتيجة

            // التحقق من كلمة المرور
            if (password_verify($password, $user['password'])) {
            // إذا كانت كلمة المرور صحيحة، تخزين البيانات في الجلسة
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                return true;
            }
        }

        // إذا لم يتم التحقق بنجاح
       return false;
    }
   






    // التحقق من صلاحية المستخدم (إدمن أو مستخدم عادي)
    public function checkRole($role) {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role) {
            return true;
        }
        return false;
    }

    // تعديل بيانات المستخدم
    public function updateProfile($userId, $data) {
        return $this->update('users', $data, ['id' => $userId]);
    }

    // حذف مستخدم
    public function deleteUser($userId) {
        return $this->delete('users', ['id' => $userId]);
    }

    // التحقق من وجود مستخدم
    public function userExists($email) {
        $user = $this->select('users', ['email' => $email]);
        return !empty($user);
    }

    // إغلاق الجلسة
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

}

?>


