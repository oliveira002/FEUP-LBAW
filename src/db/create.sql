------------------------------------
--         TABLE CREATION         --
------------------------------------

DROP TABLE IF EXISTS DeletedUser;
DROP TABLE IF EXISTS AuctionLog;
DROP TABLE IF EXISTS UserLog;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Deposit;
DROP TABLE IF EXISTS SystemManagerLog;
DROP TABLE IF EXISTS SystemManager;
DROP TABLE IF EXISTS AuctionReport;
DROP TABLE IF EXISTS SellerReport;
DROP TABLE IF EXISTS FavoriteAuction;
DROP TABLE IF EXISTS Bid;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Auction;
DROP TABLE IF EXISTS AuctionOwner;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Client;

CREATE TABLE IF NOT EXISTS Client(
    idClient    SERIAL PRIMARY KEY,
    username    VARCHAR(30) NOT NULL UNIQUE,
    password    VARCHAR(256) NOT NULL,
    email       VARCHAR(50) UNIQUE NOT NULL,
    firstName   VARCHAR(30) NOT NULL,
    lastName    VARCHAR(30) NOT NULL,
    address     VARCHAR(70),
    phoneNumber VARCHAR(13) UNIQUE,
    isBanned    BOOLEAN NOT NULL,
    balance     FLOAT NOT NULL
);

CREATE TABLE IF NOT EXISTS Category(
    idCategory  SERIAL PRIMARY KEY,
    name        VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS AuctionOwner(
    idClient SERIAL PRIMARY KEY,
    rating   FLOAT,
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT validRating CHECK((rating BETWEEN 0 AND 10) OR (rating IS NULL))
);

CREATE TABLE IF NOT EXISTS Auction(
    idAuction      SERIAL PRIMARY KEY,
    name           VARCHAR(50) NOT NULL,
    startDate      TIMESTAMP NOT NULL,
    endDate        TIMESTAMP NOT NULL,
    startingPrice  FLOAT NOT NULL,
    currentPrice   FLOAT NOT NULL,
    description    VARCHAR(1000) NOT NULL,
    isOver         BOOLEAN NOT NULL,
    idCategory     INTEGER NOT NULL,
    idOwner        INTEGER NOT NULL,
    CONSTRAINT validEndDate CHECK (endDate > startDate),
    CONSTRAINT validStartingPrice CHECK (startingPrice > 0),
    FOREIGN KEY (idCategory) REFERENCES Category ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idOwner) REFERENCES AuctionOwner ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Review(
    idReview       SERIAL PRIMARY KEY,
    rating         INTEGER NOT NULL,
    comment        VARCHAR(300),
    reviewDate     TIMESTAMP NOT NULL,
    idUserReviewer INTEGER NOT NULL,
    idUserReviewed INTEGER NOT NULL,
    CONSTRAINT validRating CHECK(rating BETWEEN 0 AND 10), 
    FOREIGN KEY (idUserReviewer) REFERENCES Client(idClient) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idUserReviewed) REFERENCES AuctionOwner(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Bid(
    idBid       SERIAL PRIMARY KEY,
    bidDate     TIMESTAMP NOT NULL,
    isValid     BOOLEAN NOT NULL,
    price       FLOAT NOT NULL,
    idClient    INTEGER NOT NULL,
    idAuction   INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS FavoriteAuction(
    idClient    INTEGER NOT NULL,
    idAuction   INTEGER NOT NULL,
    PRIMARY KEY(idClient, idAuction),
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SellerReport(
    idReport       SERIAL PRIMARY KEY,
    reportDate     TIMESTAMP NOT NULL,
    description    VARCHAR(500) NOT NULL,
    isSolved       BOOLEAN NOT NULL,
    idSeller       INTEGER NOT NULL,
    idReporter     INTEGER NOT NULL,
    FOREIGN KEY (idSeller) REFERENCES AuctionOwner(idClient) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idReporter) REFERENCES Client(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AuctionReport(
    idReport       SERIAL PRIMARY KEY,
    reportDate     TIMESTAMP NOT NULL,
    description    VARCHAR(500) NOT NULL,
    isSolved       BOOLEAN NOT NULL,
    idAuction      INTEGER NOT NULL,
    idReporter     INTEGER NOT NULL,
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idReporter) REFERENCES Client(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SystemManager(
    idSysMan    SERIAL PRIMARY KEY,
    username    VARCHAR(30) NOT NULL UNIQUE,
    email       VARCHAR(30) NOT NULL UNIQUE,
    password    VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS SystemManagerLog(
    idSysLog        SERIAL PRIMARY KEY,
    logDate         TIMESTAMP NOT NULL,
    logDescription  VARCHAR(500) NOT NULL,
    logType         VARCHAR(50) NOT NULL,
    idSysMan        INTEGER NOT NULL,
    FOREIGN KEY (idSysMan) REFERENCES SystemManager ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT TypeCheck CHECK (logType = 'Ban' OR logType = 'Unban' or logType = 'Delete' or logType = 'other')
);

CREATE TABLE IF NOT EXISTS Deposit(
    idDeposit   SERIAL PRIMARY KEY,
    amount      FLOAT NOT NULL,
    method      VARCHAR(30) NOT NULL,
    depositDate TIMESTAMP NOT NULL,
    idClient    INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT methodCheck CHECK (method = 'PAYPAL' OR method = 'MBWAY' or method = 'BANK TRANSFER' or method = 'CRYPTO' or method = 'CREDIT CARD')
);

CREATE TABLE IF NOT EXISTS Notification(
    idNotification  SERIAL PRIMARY KEY,
    content         VARCHAR(50) NOT NULL,
    isRead          BOOLEAN NOT NULL,
    notifDate       TIMESTAMP NOT NULL,
    idClient        INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS UserLog(
    idSysLog   INTEGER NOT NULL,
    idClient   INTEGER NOT NULL,
    PRIMARY KEY(idClient, idSysLog),
    FOREIGN KEY (idClient) REFERENCES Client ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idSysLog) REFERENCES SystemManagerLog ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AuctionLog(
    idSysLog    INTEGER NOT NULL,
    idAuction   INTEGER NOT NULL,
    PRIMARY KEY(idAuction, idSysLog),
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idSysLog) REFERENCES SystemManagerLog ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS DeletedUser(
    idClient INTEGER PRIMARY KEY NOT NULL, -- Has to be the same as a prior existing user
    username VARCHAR(30) UNIQUE NOT NULL
);


--------------------------------------
--          INDEX CREATION          --
--------------------------------------

-- 1) 
CREATE INDEX id_client ON Notification(idClient); 

-- 2)
CREATE INDEX auction_category ON Auction(idCategory);

-- 3)
CREATE INDEX client_username ON Client USING hash(username);


--------------------------------------
--         TRIGGER CREATION         --
--------------------------------------

-- 1) Prevent Self Bidding
DROP FUNCTION IF EXISTS check_bid() CASCADE;

CREATE FUNCTION check_bid() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF 
        (NEW.idClient = (SELECT idOwner from Auction WHERE(Auction.idAuction = New.IdAuction)))
    THEN
        RAISE EXCEPTION 'Cannot bid on your own auction';
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_bid
BEFORE INSERT ON Bid
FOR EACH ROW
EXECUTE PROCEDURE check_bid();

-- 2) Prevent Self Review
DROP FUNCTION IF EXISTS create_review() CASCADE;

CREATE FUNCTION create_review() RETURNS TRIGGER AS 
$BODY$

BEGIN
    IF 
        (NEW.idUserReviewer = NEW.idUserReviewed)
    THEN
        RAISE EXCEPTION 'Cannot review yourself';
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER create_review
BEFORE INSERT ON Review
FOR EACH ROW
EXECUTE PROCEDURE create_review();

-- 3) Updates current auction bid and prevents lower bid than current bid
DROP FUNCTION IF EXISTS create_bid() CASCADE;

CREATE FUNCTION create_bid() RETURNS TRIGGER AS 
$BODY$

BEGIN
    IF 
        (NEW.price < (SELECT currentprice FROM Auction
    WHERE(Auction.idAuction = NEW.idAuction)))
    THEN
        RAISE EXCEPTION 'Value of the bid is lower than the highest bid on the auction';
    ELSE
        UPDATE Auction SET currentprice = NEW.price WHERE (Auction.idAuction = NEW.idAuction);
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER create_bid
BEFORE INSERT ON Bid
FOR EACH ROW
EXECUTE PROCEDURE create_bid();

-- 4) Adds a user to the deleted client table after deleting on the client table
DROP FUNCTION IF EXISTS client_delete() CASCADE;

CREATE FUNCTION client_delete() RETURNS TRIGGER AS 
$BODY$
BEGIN
    insert into DeletedUser (idClient, username) values (old.idClient, old.username);
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER client_delete
AFTER DELETE ON Client
FOR EACH ROW
EXECUTE PROCEDURE client_delete();
 
-- 5) Updates an Auction Owner's review score after he receives a new review.
DROP FUNCTION IF EXISTS change_rating() CASCADE;

CREATE FUNCTION change_rating() RETURNS TRIGGER AS 
$BODY$

BEGIN
    UPDATE AuctionOwner SET rating = (Select round(sum(rating * 1.0)/count(*),2) from Review where Review.idUserReviewed = New.idUserReviewed) WHERE (AuctionOwner.IdClient = New.IdUserReviewed);
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER change_rating
AFTER INSERT ON Review
FOR EACH ROW
EXECUTE PROCEDURE change_rating();

-- 6) After an user is outbid, send him a notification
DROP FUNCTION IF EXISTS high_notif() CASCADE;

CREATE FUNCTION high_notif() RETURNS TRIGGER AS 
$BODY$

BEGIN
    INSERT INTO Notification(content,isRead,notifDate,idClient)
    (SELECT CONCAT('Outbid on Auction "', Auction.name, '"'), False, NOW(), idClient from bid, Auction where bid.idauction = NEW.IdAuction and Auction.idAuction = NEW.idAuction group by Bid.idClient,Bid.Price,Auction.name ORDER by Price DESC LIMIT 1 OFFSET 1);
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER high_notif
AFTER INSERT ON Bid
FOR EACH ROW
EXECUTE PROCEDURE high_notif();

-- 7) After a new deposit is made, increase that client's balance.
DROP FUNCTION IF EXISTS balance_update() CASCADE;

CREATE FUNCTION balance_update() RETURNS TRIGGER AS 
$BODY$
BEGIN
    UPDATE Client SET balance = (Select balance from Client where idClient = New.idClient) + New.amount WHERE Client.idClient = New.idClient;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER balance_update
AFTER INSERT ON Deposit
FOR EACH ROW
EXECUTE PROCEDURE balance_update();

-- 8) Checks if an user has any active bids or auctions before deleting his account, not allowing the deletion if he does.
DROP FUNCTION IF EXISTS check_del() CASCADE;

CREATE FUNCTION check_del() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS
        (select * from auction where auction.idOwner = OLD.idClient AND auction.endDate > NOW())
    THEN
        RAISE EXCEPTION 'Cannot delete user, he currently has active auctions';
    END IF;    
    IF EXISTS
        (select from Bid where Bid.idClient = OLD.idClient AND Bid.Price = (Select currentprice from Auction where auction.idAuction = Bid.idAuction))
    THEN
        RAISE EXCEPTION 'Cannot delete user, he currently has active bids';    
    END IF;

RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_del
BEFORE DELETE ON Client
FOR EACH ROW
EXECUTE PROCEDURE check_del();

-- 9) Check if an Owner already exists before creating auction
DROP FUNCTION IF EXISTS check_own() CASCADE;

CREATE FUNCTION check_own() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF NOT EXISTS
        (select * from AuctionOwner where AuctionOwner.idClient = NEW.idOwner)
    THEN
        INSERT INTO AuctionOwner(idClient) values (New.idOwner);
    END IF;    
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_own
BEFORE INSERT ON Auction
FOR EACH ROW
EXECUTE PROCEDURE check_own();

-- Full Text Search
ALTER TABLE Auction
ADD COLUMN tsvectors TSVECTOR;

DROP FUNCTION IF EXISTS Auction_search_update() CASCADE;

CREATE FUNCTION Auction_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A') ||
         setweight(to_tsvector('english', NEW.description), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A') ||
             setweight(to_tsvector('english', NEW.description), 'B')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER Auction_search_update
BEFORE INSERT OR UPDATE ON Auction
FOR EACH ROW
EXECUTE PROCEDURE Auction_search_update();

CREATE INDEX search_idx ON Auction USING GIN (tsvectors);
