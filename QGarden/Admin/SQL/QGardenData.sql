-- Development Level --

SET AUTOCOMMIT = 0;
SET FOREIGN_KEY_CHECKS = 0;
SET GLOBAL TIME_ZONE = '+7:00';

-- End Development Level --

-- Connection Setup --

SET CHARACTER_SET_CLIENT = 'UTF8';
SET CHARACTER_SET_RESULTS = 'UTF8';
SET CHARACTER_SET_CONNECTION = 'UTF8';
SET COLLATION_CONNECTION = 'UTF8_UNICODE_CI';

-- End Connection Setup --

USE QGarden;

/** Data Of Category **/
SET FOREIGN_KEY_CHECKS  = 0;
TRUNCATE Category;
SET AUTO_INCREMENT_OFFSET = 0;
INSERT INTO Category (CategoryName, CategoryURI, CategoryDefaultImage, CategoryTotalProduct) VALUES
('Thực Vật Trên Không', '', DEFAULT, 0),
('Cây Cảnh Để Bàn', DEFAULT, DEFAULT, DEFAULT),
('Dụng Cụ Cắt Tỉa', DEFAULT, DEFAULT, DEFAULT),
('Bình Thủy Tinh', DEFAULT, DEFAULT, DEFAULT),
('Thực Vật Bảo Mệnh', DEFAULT, DEFAULT, DEFAULT);