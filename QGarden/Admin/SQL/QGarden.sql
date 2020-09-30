-- Development Level --

SET AUTOCOMMIT = 0;
SET FOREIGN_KEY_CHECKS = 0;
SET GLOBAL TIME_ZONE = '+7:00';
SET DEFAULT_STORAGE_ENGINE = INNODB;
SET SQL_MODE = NO_AUTO_VALUE_ON_ZERO;

-- End Development Level --

-- Connection Setup --

SET CHARACTER_SET_CLIENT = 'UTF8';
SET CHARACTER_SET_RESULTS = 'UTF8';
SET CHARACTER_SET_CONNECTION = 'UTF8';
SET COLLATION_CONNECTION = 'UTF8_UNICODE_CI';

-- End Connection Setup --

START TRANSACTION;

DROP DATABASE IF EXISTS QGarden;
CREATE DATABASE IF NOT EXISTS QGarden DEFAULT CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI;

-- Create Table --

USE QGarden;

CREATE TABLE IF NOT EXISTS News
(
    NewsID             INT(5)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NewsTitle          VARCHAR(200) NOT NULL,
    NewsPreview        TEXT         NOT NULL,
    NewsContent        TEXT         NOT NULL,
    NewsDefaultImage   VARCHAR(200) NOT NULL DEFAULT N'Default.png',
    NewsCreateDate     INT(10)      NOT NULL,
    NewsCreateByUserID INT(5)       NOT NULL,
    NewsTotalComment   INT(5)       NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS Users
(
    UserID           INT(5)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserLogin        VARCHAR(200) NOT NULL,
    UserPass         VARCHAR(200) NOT NULL,
    UserName         VARCHAR(200) NOT NULL,
    UserMail         VARCHAR(200) NOT NULL,
    UserBirthday     INT(10)      NULL     DEFAULT NULL,
    UserAddress      VARCHAR(200) NULL     DEFAULT NULL,
    UserPhoneNumber  VARCHAR(10)  NOT NULL,
    UserRegisterDate INT(10)      NOT NULL,
    UserPermission   TINYINT(1)   NOT NULL,
    UserAvatar       VARCHAR(200) NOT NULL DEFAULT N'AvatarDefault.png'
);

CREATE TABLE IF NOT EXISTS Category
(
    CategoryID           INT(4)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CategoryName         VARCHAR(200) NOT NULL,
    CategoryURI          VARCHAR(200) NULL     DEFAULT NULL,
    CategoryDefaultImage VARCHAR(200) NOT NULL DEFAULT N'Default.png',
    CategoryTotalProduct INT(5)       NULL     DEFAULT 0
);

CREATE TABLE IF NOT EXISTS Products
(
    ProductID           INT(5)        NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductCategoryID   INT(4)        NOT NULL,
    ProductName         VARCHAR(200)  NOT NULL,
    ProductPrice        DOUBLE(10, 0) NOT NULL,
    ProductRateAvg      TINYINT(1)    NOT NULL DEFAULT 0,
    ProductTotalRate    TINYINT(1)    NOT NULL DEFAULT 0,
    ProductDiscount     TINYINT(1)    NOT NULL DEFAULT 0,
    ProductDefaultImage VARCHAR(200)  NOT NULL DEFAULT N'Default.png',
    ProductImageList    TEXT          NOT NULL,
    ProductPreview      TEXT          NOT NULL,
    ProductDescription  TEXT          NOT NULL,
    ProductAvailable    INT(5)        NOT NULL DEFAULT 1000,
    ProductTotalReview  INT(5)        NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS Comments
(
    CommentID          INT(11)    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CommentContent     TEXT       NOT NULL,
    CommentOfUserID    INT(5)     NOT NULL,
    CommentOnProductID INT(5)     NULL DEFAULT NULL,
    CommentOnNewsID    INT(5)     NULL DEFAULT NULL,
    CommentReplyOnID   INT(11)    NULL DEFAULT NULL,
    CommentRatedStar   TINYINT(1) NULL DEFAULT NULL,
    CommentCreatedDate INT(10)    NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS Bill
(
    BillID              INT(11)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BillOfUserID        INT(5)        NULL     DEFAULT NULL,
    UserShippingAddress VARCHAR(200)  NOT NULL,
    UserPhoneNumber     VARCHAR(10)   NOT NULL,
    UserMail            VARCHAR(200)  NOT NULL,
    BillStatus          TINYINT(1)    NOT NULL DEFAULT 0,
    BillCreateDate      INT(10)       NOT NULL,
    BillCompletedDate   INT(10)       NULL     DEFAULT NULL,
    BillTotalCost       DOUBLE(10, 0) NOT NULL,
    BillPaymentMethod   TINYINT(1)    NOT NULL DEFAULT 0,
    UsedCouponID        INT(5)        NULL     DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS BillDetail
(
    BillDetailID   INT(11)    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BillID         INT(11)    NOT NULL,
    ProductID      INT(5)     NOT NULL,
    ProductCount   TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS SiteInfo
(
    SiteName         VARCHAR(200) NOT NULL,
    About            TEXT         NOT NULL,
    ContactAddress   TEXT         NOT NULL,
    ContactPhoneLine VARCHAR(20)  NOT NULL,
    CustomerCareLine VARCHAR(20)  NOT NULL,
    ContactMail      VARCHAR(200) NOT NULL,
    FacebookSocial   VARCHAR(200) NULL DEFAULT NULL,
    GoogleSocial     VARCHAR(200) NULL DEFAULT NULL,
    IGSocial         VARCHAR(200) NULL DEFAULT NULL,
    YoutubeSocial    VARCHAR(200) NULL DEFAULT NULL,
    SiteKeyword      TEXT         NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS Coupons
(
    CouponID               INT(5)              NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CouponCode             VARCHAR(150) UNIQUE NOT NULL,
    CouponDiscount         TINYINT(1)          NOT NULL DEFAULT 10,
    CreateDate             INT(10)             NOT NULL,
    ExpireDate             INT(10)             NOT NULL,
    CouponCreatedByAdminID INT(5)              NOT NULL
);

CREATE TABLE IF NOT EXISTS FlashSale
(
    SaleID               INT(5)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ProductID            INT(5)  NOT NULL,
    SaleCreateDate       INT(10) NOT NULL,
    SaleExpireDate       INT(10) NOT NULL,
    SaleCreatedByAdminID INT(5)  NOT NULL
);

CREATE TABLE IF NOT EXISTS Banner
(
    BannerID     INT(5)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BannerImage  VARCHAR(200) NOT NULL,
    BannerStatus TINYINT(1)   NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS ReceivedContact
(
    ContactID      INT(5)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserName       VARCHAR(200) NOT NULL,
    UserMail       VARCHAR(200) NOT NULL,
    FromUserID     INT(5)       NULL DEFAULT NULL,
    ContactSubject TEXT         NOT NULL,
    ContactMessage TEXT         NOT NULL
);

-- Create --

USE QGarden;

ALTER TABLE News
    ADD CONSTRAINT FK_News_Create_By_UserID FOREIGN KEY News (NewsCreateByUserID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE Products
    ADD CONSTRAINT Product_In_CategoryID FOREIGN KEY Products (ProductCategoryID)
        REFERENCES Category (CategoryID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE Comments
    ADD CONSTRAINT FK_Commented_By_UserID FOREIGN KEY Comments (CommentOfUserID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE,

    ADD CONSTRAINT FK_Comment_On_ProductID FOREIGN KEY Comments (CommentOnProductID)
        REFERENCES Products (ProductID)
        ON DELETE NO ACTION ON UPDATE CASCADE,

    ADD CONSTRAINT FK_Comment_On_NewsID FOREIGN KEY Comments (CommentOnNewsID)
        REFERENCES News (NewsID)
        ON DELETE NO ACTION ON UPDATE CASCADE,

    ADD CONSTRAINT FK_Rely_On_CommentID FOREIGN KEY Comments (CommentReplyOnID)
        REFERENCES Comments (CommentID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE Bill
    ADD CONSTRAINT FK_Bill_Of_UserID FOREIGN KEY Bill (BillOfUserID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE,
    ADD CONSTRAINT FK_Bill_Used_Coupon FOREIGN KEY Bill (UsedCouponID)
        REFERENCES Coupons (CouponID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE BillDetail
    ADD CONSTRAINT FK_BillDetail_Of_BillID FOREIGN KEY BillDetail (BillID)
        REFERENCES Bill (BillID)
        ON DELETE NO ACTION ON UPDATE CASCADE,
    ADD CONSTRAINT FK_BillDetail_Of_Bill_With_ProductID FOREIGN KEY BillDetail (ProductID)
        REFERENCES Products (ProductID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE Coupons
    ADD CONSTRAINT FK_Coupon_Created_By_AdminID FOREIGN KEY Coupons (CouponCreatedByAdminID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE FlashSale
    ADD CONSTRAINT FK_Sale_Created_By_AdminID FOREIGN KEY FlashSale (SaleCreatedByAdminID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE,
    ADD CONSTRAINT FK_FlashSale_On_ProductID FOREIGN KEY FlashSale (ProductID)
        REFERENCES Products (ProductID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE ReceivedContact
    ADD CONSTRAINT FK_Received_Contact_From_UserID FOREIGN KEY ReceivedContact (FromUserID)
        REFERENCES Users (UserID)
        ON DELETE NO ACTION ON UPDATE CASCADE;

COMMIT;