<?
        require_once('settings.php');

        echo "<h1>УДАЛИТЕ ФАЙЛ ПОСЛЕ ОТКРЫТИЯ</h1> <br><br>";

        $conn = mysqli_connect(DB_ADRESS, DB_LOGIN, DB_PSWD);
        $db = DB_NAME;
        
        q("DROP DATABASE IF EXISTS $db");
        q("CREATE DATABASE $db");
        
        $tables = [
            'Product' => "
                id_prod BIGINT PRIMARY KEY AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                descript text NOT NULL,
                stock ENUM('в магазине', 'предзаказ', 'нет в наличии') NOT NULL,
                CONSTRAINT uc_ProductName UNIQUE(name)",
            'Prod_img' => "
                id_img BIGINT PRIMARY KEY AUTO_INCREMENT,
                img_name varchar(255) NOT NULL,
                id_prod BIGINT NOT NULL,
                CONSTRAINT fk_id_prod_img FOREIGN KEY (id_prod) REFERENCES Product(id_prod)",
            'Prod_comment' => "
                id_comment BIGINT PRIMARY KEY AUTO_INCREMENT,
                name varchar(150) DEFAULT 'Аноним',
                comment text NOT NULL,
                id_prod BIGINT NOT NULL,
                CONSTRAINT fk_id_prod_comment FOREIGN KEY (id_prod) REFERENCES Product(id_prod)",
            'Prod_price' => "
                id_price BIGINT PRIMARY KEY AUTO_INCREMENT,
                descript varchar(50) NOT NULL,
                price BIGINT NOT NULL,
                id_prod BIGINT NOT NULL,
                CONSTRAINT fk_id_prod_price FOREIGN KEY (id_prod) REFERENCES Product(id_prod)",
            'Category' => "
                id_cat BIGINT PRIMARY KEY AUTO_INCREMENT,
                cat_name varchar(30) NOT NULL,
                section ENUM('электроника', 'аксессуары') NOT NULL,
                id_prod BIGINT NOT NULL,
                CONSTRAINT fk_id_prod_cat FOREIGN KEY (id_prod) REFERENCES Product(id_prod)",
            'Pages' => "
                id_page BIGINT PRIMARY KEY AUTO_INCREMENT,
                short_name varchar(20) NOT NULL,
                url varchar(30) NOT NULL,
                content text NOT NULL"
        ];

        mysqli_select_db($conn, $db);
        
        foreach ($tables as $key => $value) {
            q("DROP TABLE IF EXISTS $key");
            q("CREATE TABLE $key($value)");
        }


        function q($sql) {
            global $conn;
            if (mysqli_query($conn, $sql))
                echo "Запрос <br>'$sql' <br> <strong>OK</strong>";
            else
                echo "Запрос <br>'$sql' <br> <strong>ОШИБКА ".mysqli_error($conn)."</strong>";
            echo "<br><br>";
        }  
?>