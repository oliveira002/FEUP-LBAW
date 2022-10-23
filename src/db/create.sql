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

-- 5) Prevents invalid auction start date
DROP FUNCTION IF EXISTS check_auction() CASCADE;

CREATE FUNCTION check_auction() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF 
        (NEW.endDate < NEW.startDate)
    THEN
        RAISE EXCEPTION 'Cant create an auction with invalid date';
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;



CREATE TRIGGER check_auction
BEFORE INSERT ON Auction
FOR EACH ROW
EXECUTE PROCEDURE check_auction(); 

-- Full Text Search
ALTER TABLE Auction
ADD COLUMN tsvectors TSVECTOR;

DROP FUNCTION IF EXISTS Auction_search_update() CASCADE;

CREATE FUNCTION Auction_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('portuguese', NEW.name), 'A') ||
         setweight(to_tsvector('portuguese', NEW.description), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('portuguese', NEW.name), 'A') ||
             setweight(to_tsvector('portuguese', NEW.description), 'B')
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


--------------------------------------
--          INDEX CREATION          --
--------------------------------------

-- 1) 
CREATE INDEX id_client ON Notification USING hash(idClient) where isRead = false;

-- 2)
CREATE INDEX auction_category ON Auction USING hash (idCategory);

-- 3)
CREATE INDEX curr_bid ON Auction(currentPrice);
