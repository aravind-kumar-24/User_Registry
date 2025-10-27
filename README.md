SQL Queries:

--> Database Creation Query

        CREATE DATABASE user_registry;

--> Table Creation & Insertion Queries

    --> Countries table:

            CREATE TABLE countries(
                id INT PRIMARY KEY AUTO_INCREMENT,
                country_name VARCHAR(100) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );

            INSERT INTO countries (country_name)
            VALUES 
                ('India'),
                ('United States'),
                ('United Kingdom'),
                ('Canada'),
                ('Australia'),
                ('Germany'),
                ('France'),
                ('Italy'),
                ('Spain'),
                ('Brazil'),
                ('Japan'),
                ('China'),
                ('South Africa'),
                ('Mexico'),
                ('Indonesia');

    --> States table:

            CREATE TABLE states(
                id INT PRIMARY KEY AUTO_INCREMENT,
                country_id INT NOT NULL,
                state_name VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE CASCADE
            );

            INSERT INTO states (country_id, state_name) 
            VALUES
                (1, 'Tamil Nadu'),
                (1, 'Karnataka'),
                (1, 'Maharashtra'),
                (1, 'Gujarat'),
                (1, 'Kerala'),
                (2, 'California'),
                (2, 'Texas'),
                (2, 'Florida'),
                (2, 'New York'),
                (2, 'Illinois'),
                (3, 'England'),
                (3, 'Scotland'),
                (3, 'Wales'),
                (3, 'Northern Ireland'),
                (3, 'Cornwall'),
                (4, 'Ontario'),
                (4, 'Quebec'),
                (4, 'British Columbia'),
                (4, 'Alberta'),
                (4, 'Manitoba'),
                (5, 'New South Wales'),
                (5, 'Victoria'),
                (5, 'Queensland'),
                (5, 'Western Australia'),
                (5, 'South Australia'),
                (6, 'Bavaria'),
                (6, 'Berlin'),
                (6, 'Hesse'),
                (6, 'Saxony'),
                (6, 'Hamburg'),
                (7, 'Île-de-France'),
                (7, 'Provence-Alpes-Côte d\'Azur'),
                (7, 'Normandy'),
                (7, 'Brittany'),
                (7, 'Occitanie'),
                (8, 'Lombardy'),
                (8, 'Lazio'),
                (8, 'Sicily'),
                (8, 'Veneto'),
                (8, 'Tuscany'),
                (9, 'Catalonia'),
                (9, 'Madrid'),
                (9, 'Andalusia'),
                (9, 'Valencia'),
                (9, 'Galicia'),
                (10, 'São Paulo'),
                (10, 'Rio de Janeiro'),
                (10, 'Bahia'),
                (10, 'Minas Gerais'),
                (10, 'Paraná'),
                (11, 'Tokyo'),
                (11, 'Osaka'),
                (11, 'Hokkaido'),
                (11, 'Kyoto'),
                (11, 'Fukuoka'),
                (12, 'Beijing'),
                (12, 'Shanghai'),
                (12, 'Guangdong'),
                (12, 'Sichuan'),
                (12, 'Zhejiang'),
                (13, 'Gauteng'),
                (13, 'KwaZulu-Natal'),
                (13, 'Western Cape'),
                (13, 'Eastern Cape'),
                (13, 'Limpopo'),
                (14, 'Jalisco'),
                (14, 'Nuevo León'),
                (14, 'Chihuahua'),
                (14, 'Puebla'),
                (14, 'Oaxaca'),
                (15, 'Jakarta'),
                (15, 'Bali'),
                (15, 'Java'),
                (15, 'Sumatra'),
                (15, 'Sulawesi');

    --> Users table:

            CREATE TABLE users(
                id INT PRIMARY KEY AUTO_INCREMENT,
                user_id VARCHAR(25) NOT NULL UNIQUE,
                first_name VARCHAR(25) NOT NULL,
                last_name VARCHAR(25) NOT NULL,
                email_id VARCHAR(100) NOT NULL UNIQUE,
                mobile_number VARCHAR(10) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                user_type TINYINT NOT NULL COMMENT '1 = Admin, 2 = Normal User, etc.',
                gender ENUM('Male', 'Female', 'Others') NOT NULL,
                date_of_birth DATE NOT NULL,
                country_id INT NOT NULL,
                state_id INT NOT NULL,
                address TEXT NOT NULL,
                profile_path VARCHAR(100) DEFAULT NULL,
                profile_image VARCHAR(100) DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL,
                FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE RESTRICT,
                FOREIGN KEY (state_id) REFERENCES states(id) ON DELETE RESTRICT
            );