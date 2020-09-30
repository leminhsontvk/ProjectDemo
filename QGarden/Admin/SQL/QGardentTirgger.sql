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

DROP TRIGGER IF EXISTS Increase_Total_Comment;
DROP TRIGGER IF EXISTS Increase_Total_Product;
DROP TRIGGER IF EXISTS Decrease_Total_Product;
DROP TRIGGER IF EXISTS Decrease_Total_Comment;
DROP TRIGGER IF EXISTS Is_Use_Default_User_Info;
DROP TRIGGER IF EXISTS Decrease_Bill_Total_Product;

START TRANSACTION;

USE QGarden;

CREATE TRIGGER Increase_Total_Comment
    AFTER INSERT
    ON Comments
    FOR EACH ROW
BEGIN
    IF NEW.CommentOnNewsID IS NOT NULL THEN
        UPDATE News
        SET NewsTotalComment = NewsTotalComment + 1
        WHERE NEW.CommentOnNewsID = News.NewsID;
    END IF;

    IF NEW.CommentOnProductID AND NEW.CommentRatedStar IS NOT NULL THEN
        UPDATE Products
        SET ProductTotalRate = ProductTotalRate + 1,
            ProductTotalReview = ProductTotalReview + 1
        WHERE NEW.CommentOnProductID = Products.ProductID;
    END IF;

    IF NEW.CommentReplyOnID IS NOT NULL THEN
        UPDATE News, Comments
        SET News.NewsTotalComment = News.NewsTotalComment + 1
        WHERE Comments.CommentReplyOnID = Comments.CommentID
          AND Comments.CommentOnNewsID = News.NewsID;
    END IF;
END;

CREATE TRIGGER Decrease_Total_Comment
    AFTER DELETE
    ON Comments
    FOR EACH ROW
BEGIN
    IF OLD.CommentOnNewsID IS NOT NULL THEN
        UPDATE News
        SET NewsTotalComment = NewsTotalComment - 1
        WHERE OLD.CommentOnNewsID = News.NewsID;
    END IF;

    IF OLD.CommentOnProductID AND OLD.CommentRatedStar IS NOT NULL THEN
        UPDATE Products
        SET ProductTotalRate = ProductTotalRate - 1,
            ProductTotalReview = ProductTotalReview - 1
        WHERE OLD.CommentOnProductID = Products.ProductID;
    END IF;

    IF OLD.CommentReplyOnID IS NOT NULL THEN
        UPDATE News, Comments
        SET News.NewsTotalComment = News.NewsTotalComment - 1
        WHERE Comments.CommentReplyOnID = Comments.CommentID
          AND Comments.CommentOnNewsID = News.NewsID;
    END IF;
END;

CREATE TRIGGER Is_Use_Default_User_Info
    BEFORE INSERT
    ON Bill
    FOR EACH ROW
BEGIN
    IF NEW.BillOfUserID IS NOT NULL THEN
        IF NEW.UserPhoneNumber IS NULL THEN
            UPDATE NEW, Users
            SET NEW.UserPhoneNumber = Users.UserPhoneNumber
            WHERE NEW.BillOfUserID = Users.UserID;
        END IF;

        IF NEW.UserShippingAddress IS NULL THEN
            UPDATE NEW, Users
            SET NEW.UserShippingAddress = Users.UserAddress
            WHERE NEW.BillOfUserID = Users.UserID;
        END IF;

        IF NEW.UserMail IS NULL THEN
            UPDATE NEW, Users
            SET NEW.UserMail = Users.UserMail
            WHERE NEW.BillOfUserID = Users.UserID;
        END IF;
    END IF;
END;

CREATE TRIGGER Increase_Total_Product
    AFTER INSERT
    ON Products
    FOR EACH ROW
BEGIN
    IF NEW.ProductCategoryID IS NOT NULL THEN
        UPDATE Category
        SET Category.CategoryTotalProduct = Category.CategoryTotalProduct + 1
        WHERE Category.CategoryID = NEW.ProductCategoryID;
    END IF;
end;

CREATE TRIGGER Decrease_Total_Product
    AFTER DELETE
    ON Products
    FOR EACH ROW
BEGIN
    IF OLD.ProductCategoryID IS NOT NULL THEN
        UPDATE Category
        SET Category.CategoryTotalProduct = Category.CategoryTotalProduct - 1
        WHERE Category.CategoryID = OLD.ProductCategoryID;
    END IF;
END;

CREATE TRIGGER Decrease_Bill_Total_Product
    AFTER INSERT
    ON BillDetail
    FOR EACH ROW
BEGIN
    IF NEW.ProductID IS NOT NULL AND NEW.ProductCount >= 1 THEN
        UPDATE Products
        SET Products.ProductAvailable = Products.ProductAvailable - NEW.ProductCount
        WHERE Products.ProductID = NEW.ProductID;
    END IF;
END;
COMMIT;