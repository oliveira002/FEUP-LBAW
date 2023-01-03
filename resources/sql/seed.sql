create schema if not exists lbaw2225;
------------------------------------
--         TABLE CREATION         --
------------------------------------
DROP TABLE IF EXISTS BanAppeals;
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
DROP TABLE IF EXISTS "user";

CREATE TABLE IF NOT EXISTS "user"(
    idClient    SERIAL PRIMARY KEY,
    username    VARCHAR(30) NOT NULL UNIQUE,
    password    VARCHAR(256) NOT NULL,
    email       VARCHAR(50) UNIQUE NOT NULL,
    firstName   VARCHAR(30) NOT NULL,
    lastName    VARCHAR(30) NOT NULL,
    address     VARCHAR(70),
    phoneNumber VARCHAR(13) UNIQUE,
    isBanned    BOOLEAN NOT NULL,
    balance     FLOAT NOT NULL,
    remember_token TEXT
);

CREATE TABLE IF NOT EXISTS Category(
    idCategory  SERIAL PRIMARY KEY,
    name        VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS AuctionOwner(
    idClient SERIAL PRIMARY KEY,
    rating   FLOAT DEFAULT 0,
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE,
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
    FOREIGN KEY (idUserReviewer) REFERENCES "user"(idClient) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idUserReviewed) REFERENCES AuctionOwner(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Bid(
    idBid       SERIAL PRIMARY KEY,
    bidDate     TIMESTAMP NOT NULL,
    isValid     BOOLEAN NOT NULL,
    price       FLOAT NOT NULL,
    idClient    INTEGER NOT NULL,
    idAuction   INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS FavoriteAuction(
    idClient    INTEGER NOT NULL,
    idAuction   INTEGER NOT NULL,
    PRIMARY KEY(idClient, idAuction),
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE,
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
    FOREIGN KEY (idReporter) REFERENCES "user"(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AuctionReport(
    idReport       SERIAL PRIMARY KEY,
    reportDate     TIMESTAMP NOT NULL,
    description    VARCHAR(500) NOT NULL,
    isSolved       BOOLEAN NOT NULL,
    idAuction      INTEGER NOT NULL,
    idReporter     INTEGER NOT NULL,
    FOREIGN KEY (idAuction) REFERENCES Auction ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idReporter) REFERENCES "user"(idClient) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SystemManager(
    idSysMan    SERIAL PRIMARY KEY,
    username    VARCHAR(30) NOT NULL UNIQUE,
    email       VARCHAR(30) NOT NULL UNIQUE,
    password    VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS SystemManagerLog(
    idSysLog        SERIAL PRIMARY KEY,
    logDate         TIMESTAMP NOT NULL,
    logDescription  VARCHAR(500) NOT NULL,
    logType         VARCHAR(50) NOT NULL,
    idSysMan        INTEGER NOT NULL,
    FOREIGN KEY (idSysMan) REFERENCES SystemManager ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT TypeCheck CHECK (logType = 'Ban' OR logType = 'Unban' or logType = 'Create User' or logType = 'Update Report' or logType = 'Delete User' or logType = 'Delete Auction' or logType = 'Update Auction' or logType = 'Delete Bid' or logType = 'other')
);

CREATE TABLE IF NOT EXISTS Deposit(
    idDeposit   SERIAL PRIMARY KEY,
    amount      FLOAT NOT NULL,
    method      VARCHAR(30) NOT NULL,
    depositDate TIMESTAMP NOT NULL,
    idClient    INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT methodCheck CHECK (method = 'PAYPAL' OR method = 'MBWAY' or method = 'BANK TRANSFER' or method = 'CRYPTO' or method = 'CREDIT CARD')
);

CREATE TABLE IF NOT EXISTS Notification(
    idNotification  SERIAL PRIMARY KEY,
    content         VARCHAR(300) NOT NULL,
    isRead          BOOLEAN NOT NULL,
    notifDate       TIMESTAMP NOT NULL,
    idClient        INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS UserLog(
    idSysLog   INTEGER NOT NULL,
    idClient   INTEGER NOT NULL,
    PRIMARY KEY(idClient, idSysLog),
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE,
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

CREATE TABLE IF NOT EXISTS BanAppeals(
    idBanAppeal SERIAL PRIMARY KEY,
    appealDate TIMESTAMP NOT NULL,
    appealDescription  VARCHAR(500) NOT NULL,
    idClient        INTEGER NOT NULL,
    FOREIGN KEY (idClient) REFERENCES "user" ON UPDATE CASCADE ON DELETE CASCADE
);


--------------------------------------
--          INDEX CREATION          --
--------------------------------------

-- 1)
CREATE INDEX id_client ON Notification(idClient);

-- 2)
CREATE INDEX auction_category ON Auction(idCategory);

-- 3)
CREATE INDEX user_username ON "user" USING hash(username);


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

-- 4) Adds a user to the deleted "user" table after deleting on the "user" table
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
AFTER DELETE ON "user"
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

-- 7) After a new deposit is made, increase that "user"'s balance.
DROP FUNCTION IF EXISTS balance_update() CASCADE;

CREATE FUNCTION balance_update() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE "user" SET balance = (Select balance from "user" where idClient = New.idClient) + New.amount WHERE "user".idClient = New.idClient;
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
        (SELECT * from bid JOIN auction ON bid.idAuction = auction.idAuction
                    WHERE idClient = OLD.idclient AND price = (
                        SELECT MAX(price) FROM bid b2 WHERE b2.idAuction = bid.idAuction
                    ) AND auction.isover = false
                            )
    THEN
        RAISE EXCEPTION 'Cannot delete user, he currently has active bids';
    END IF;

RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_del
BEFORE DELETE ON "user"
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

-- 10) notification for the auction owner
DROP FUNCTION IF EXISTS newbid_notif() CASCADE;

CREATE FUNCTION newbid_notif() RETURNS TRIGGER AS
    $BODY$

BEGIN
INSERT INTO Notification(content,isRead,notifDate,idClient)
    (SELECT CONCAT('New Bid on Auction "', Auction.name, '"'), False, NOW(), Auction.idOwner from Auction where Auction.idauction = NEW.IdAuction);
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER newbid_notif
    AFTER INSERT ON Bid
    FOR EACH ROW
    EXECUTE PROCEDURE newbid_notif();

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

insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (1, 'cminister0', 'cminister0@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Constantina', 'Minister', '42749 Holmberg Trail', '2516074366', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (2, 'tmaciak1', 'tmaciak1@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Tammy', 'Maciak', '9 Elka Terrace', '8008783943', true, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (3, 'ethorsby2', 'ethorsby2@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Eloise', 'Thorsby', '91 Stoughton Plaza', '5559455818', true, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (4, 'ipolo3', 'ipolo3@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Inness', 'Polo', '7 Pepper Wood Pass', '3373728347', true, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (5, 'mgoodchild4', 'mgoodchild4@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Margette', 'Goodchild', '06902 Anthes Hill', '3733114159', true, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (6, 'rgeeson5', 'rgeeson5@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Rouvin', 'Geeson', '5 Eastlawn Court', '1735779156', true, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (7, 'epepperill6', 'epepperill6@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Edin', 'Pepperill', '07332 Amoth Avenue', '7578641793', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (8, 'abillings7', 'abillings7@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Augusto', 'Billings', '0229 Briar Crest Court', '4556929801', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (9, 'mbrasse8', 'mbrasse8@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Moss', 'Brasse', '94 Clarendon Center', '8372668442', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (10, 'ncasassa9', 'ncasassa9@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Nadine', 'Casassa', '5725 6th Place', '9222548522', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (11, 'lhakonsena', 'lhakonsena@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Lorianne', 'Hakonsen', '833 Iowa Trail', '9901036704', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (12, 'fcordieb', 'fcordieb@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Fionna', 'Cordie', '53 Kingsford Parkway', '9054830509', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (13, 'dfronczakc', 'dfronczakc@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Donielle', 'Fronczak', '964 Pankratz Court', '8967767108', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (14, 'bklaffsd', 'bklaffsd@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Brocky', 'Klaffs', '48 School Road', '9645930760', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (15, 'ksherrelle', 'ksherrelle@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Kimbra', 'Sherrell', '0 Nancy Plaza', '2418005297', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (16, 'tedensf', 'tedensf@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Tammi', 'Edens', '40 Little Fleur Center', '6733884752', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (17, 'tharperg', 'tharperg@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Terrye', 'Harper', '17 Farwell Lane', '2538110187', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (18, 'anewloveh', 'anewloveh@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Alaster', 'Newlove', '6027 Weeping Birch Pass', '6152492435', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (19, 'gingremi', 'gingremi@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Gerti', 'Ingrem', '5 Talisman Lane', '6456679802', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (20, 'jambrogettij', 'jambrogettij@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Jaimie', 'Ambrogetti', '975 Cascade Park', '6263255233', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (21, 'bgebbiek', 'bgebbiek@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Bell', 'Gebbie', '6 Mandrake Circle', '6383170915', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (22, 'pkerinl', 'pkerinl@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Pru', 'Kerin', '61366 Lyons Trail', '2489886503', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (23, 'hfaganm', 'hfaganm@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Hannie', 'Fagan', '5030 Myrtle Road', '6954227386', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (24, 'dcrosettin', 'dcrosettin@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Dru', 'Crosetti', '7344 Jenna Street', '1691605366', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (25, 'vbennieo', 'vbennieo@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Virgie', 'Bennie', '6195 Weeping Birch Terrace', '3152855560', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (26, 'vradleyp', 'vradleyp@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Verney', 'Radley', '34381 Monica Point', '2501543505', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (27, 'drichemondq', 'drichemondq@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Dorthea', 'Richemond', '8 Hintze Park', '5184722393', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (28, 'gkermitr', 'gkermitr@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Gena', 'Kermit', '262 Saint Paul Point', '7165761225', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (29, 'djantots', 'djantots@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Dani', 'Jantot', '9483 Ludington Avenue', '4757376851', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (30, 'oglisont', 'oglisont@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Ophelie', 'Glison', '355 Eggendart Road', '3033973430', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (31, 'edraxfordu', 'edraxfordu@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Ema', 'Draxford', '9354 Miller Circle', '8055037953', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (32, 'aohengertyv', 'aohengertyv@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Abigale', 'O''Hengerty', '88 Meadow Valley Avenue', '6136600357', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (33, 'eninnoliw', 'eninnoliw@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Emmye', 'Ninnoli', '42451 Gale Parkway', '7735415439', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (34, 'bsutex', 'bsutex@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Baillie', 'Sute', '6431 Anderson Lane', '1683096776', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (35, 'dhadkinsy', 'dhadkinsy@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Dirk', 'Hadkins', '21505 Merry Pass', '9197982168', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (36, 'rodriscollz', 'rodriscollz@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Ronny', 'O''Driscoll', '7 Briar Crest Crossing', '1379884943', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (37, 'llownds10', 'llownds10@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Lacie', 'Lownds', '410 Canary Lane', '7973065510', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (38, 'oglisane11', 'oglisane11@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Odell', 'Glisane', '6 Messerschmidt Junction', '5691147110', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (39, 'cygoe12', 'cygoe12@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Corrianne', 'Ygoe', '224 Valley Edge Pass', '6051967235', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (40, 'ekennewell13', 'ekennewell13@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Edik', 'Kennewell', '505 Mariners Cove Plaza', '7999673696', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (41, 'glowless14', 'glowless14@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Gerri', 'Lowless', '8 Maple Court', '7765876471', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (42, 'xcoare15', 'xcoare15@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Xymenes', 'Coare', '9 Marquette Avenue', '6025371724', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (43, 'egarrioch16', 'egarrioch16@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Evan', 'Garrioch', '44 Hansons Center', '6262412392', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (44, 'hmicka17', 'hmicka17@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Hew', 'Micka', '60882 Jenna Parkway', '9001813614', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (45, 'usains18', 'usains18@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Udall', 'Sains', '9521 American Hill', '6336656047', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (46, 'ilohde19', 'ilohde19@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Iggie', 'Lohde', '25 Oak Trail', '1527153317', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (47, 'gteeney1a', 'gteeney1a@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Gallagher', 'Teeney', '9 Lukken Avenue', '1393168506', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (48, 'cfripp1b', 'cfripp1b@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Clemmie', 'Fripp', '9 Nancy Court', '3215782114', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (49, 'arenals1c', 'arenals1c@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Alana', 'Renals', '378 Montana Road', '7489661244', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (50, 'ckilmurry1d', 'ckilmurry1d@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Camey', 'Kilmurry', '12882 2nd Plaza', '7945908910', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (51, 'hcossem1e', 'hcossem1e@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Husain', 'Cossem', '9 Kropf Drive', '8679797470', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (52, 'wtape1f', 'wtape1f@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Wilfrid', 'Tape', '427 Bartillon Avenue', '5038530707', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (53, 'ypilkington1g', 'ypilkington1g@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Yetty', 'Pilkington', '4 Hagan Road', '6198933261', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (54, 'cmetzel1h', 'cmetzel1h@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Conan', 'Metzel', '6791 Sunfield Lane', '3951903485', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (55, 'kstark1i', 'kstark1i@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Kat', 'Stark', '175 Lien Circle', '7086882974', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (56, 'jclarey1j', 'jclarey1j@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Jesse', 'Clarey', '68 Amoth Center', '3447010173', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (57, 'bparnaby1k', 'bparnaby1k@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Barbabra', 'Parnaby', '19 Vera Plaza', '3722354942', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (58, 'bwarton1l', 'bwarton1l@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Benedikt', 'Warton', '026 Miller Alley', '7052702136', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (59, 'btondeur1m', 'btondeur1m@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Borden', 'Tondeur', '3 Mallard Park', '6141467017', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (60, 'awaszkiewicz1n', 'awaszkiewicz1n@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Addi', 'Waszkiewicz', '51350 Oxford Way', '3029320066', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (61, 'ljosefsen1o', 'ljosefsen1o@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Leigh', 'Josefsen', '90008 Cardinal Street', '1526142422', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (62, 'kmoggach1p', 'kmoggach1p@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Korie', 'Moggach', '29441 North Road', '1735588255', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (63, 'jgierck1q', 'jgierck1q@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Janelle', 'Gierck', '5637 Bunker Hill Hill', '8307607569', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (64, 'ttimbs1r', 'ttimbs1r@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Tommy', 'Timbs', '3002 Wayridge Hill', '9739834214', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (65, 'alunbech1s', 'alunbech1s@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Ardyth', 'Lunbech', '47505 Eggendart Parkway', '4331322192', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (66, 'rcroy1t', 'rcroy1t@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Rolando', 'Croy', '9061 Spenser Center', '7006858673', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (67, 'mogbourne1u', 'mogbourne1u@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Michel', 'Ogbourne', '90638 Miller Parkway', '3933040129', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (68, 'ftruscott1v', 'ftruscott1v@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Faustina', 'Truscott', '11 Stone Corner Point', '4346036961', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (69, 'ttetlow1w', 'ttetlow1w@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Tommie', 'Tetlow', '095 Fallview Park', '3679372572', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (70, 'blaurenzi1x', 'blaurenzi1x@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Benjamen', 'Laurenzi', '79513 Claremont Parkway', '2055752923', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (71, 'speret1y', 'speret1y@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Stephine', 'Peret', '118 Milwaukee Way', '7081186362', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (72, 'fgoaks1z', 'fgoaks1z@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Faulkner', 'Goaks', '36018 Dovetail Avenue', '7387863226', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (73, 'rbaggelley20', 'rbaggelley20@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Raina', 'Baggelley', '26989 Sycamore Parkway', '9299506248', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (74, 'afullom21', 'afullom21@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Austen', 'Fullom', '8 Sunbrook Street', '9288377172', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (75, 'thenworth22', 'thenworth22@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Tedd', 'Henworth', '91613 Dexter Road', '8299683645', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (76, 'dmacmorland23', 'dmacmorland23@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Danila', 'MacMorland', '227 Roth Place', '7926263373', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (77, 'lraraty24', 'lraraty24@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Latisha', 'Raraty', '657 Eagan Road', '5112149554', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (78, 'psodory25', 'psodory25@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Powell', 'Sodory', '03807 Myrtle Circle', '4884349382', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (79, 'jgaratty26', 'jgaratty26@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Julina', 'Garatty', '53047 Cottonwood Road', '5558992542', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (80, 'caymes27', 'caymes27@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Cross', 'Aymes', '7584 Eliot Parkway', '7755908393', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (81, 'tnorval28', 'tnorval28@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Thorvald', 'Norval', '72346 Straubel Crossing', '6909725178', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (82, 'lspaunton29', 'lspaunton29@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Lauraine', 'Spaunton', '9256 Sugar Parkway', '8658446055', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (83, 'dpressey2a', 'dpressey2a@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Dominic', 'Pressey', '68041 Erie Pass', '2768496430', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (84, 'jfurber2b', 'jfurber2b@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Jennee', 'Furber', '522 Spaight Pass', '8306840210', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (85, 'bgrealish2c', 'bgrealish2c@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Brear', 'Grealish', '91955 Twin Pines Junction', '1731441560', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (86, 'akeets2d', 'akeets2d@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Alfredo', 'Keets', '8392 Bluestem Court', '1018456130', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (87, 'atemplman2e', 'atemplman2e@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Aurea', 'Templman', '5 Clove Trail', '1794047856', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (88, 'lcrayker2f', 'lcrayker2f@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Leeland', 'Crayker', '99 Pawling Plaza', '8625020011', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (89, 'epestricke2g', 'epestricke2g@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Ethel', 'Pestricke', '2 Forest Run Trail', '4722848515', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (90, 'hnorthgraves2h', 'hnorthgraves2h@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Herold', 'Northgraves', '16941 Farwell Crossing', '4682333786', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (91, 'mrizzardi2i', 'mrizzardi2i@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Maddy', 'Rizzardi', '76434 Longview Junction', '1781173823', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (92, 'kmcgreal2j', 'kmcgreal2j@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Kurt', 'McGreal', '5431 Harper Terrace', '8842414318', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (93, 'slound2k', 'slound2k@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Steffen', 'Lound', '07 Swallow Court', '1909567354', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (94, 'rslay2l', 'rslay2l@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Reade', 'Slay', '9090 Elgar Road', '7695797100', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (95, 'rkerrigan2m', 'rkerrigan2m@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Robyn', 'Kerrigan', '2120 Grasskamp Court', '9515914536', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (96, 'kgietz2n', 'kgietz2n@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Katrine', 'Gietz', '9031 Ramsey Trail', '8027830091', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (97, 'afonzone2o', 'afonzone2o@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Alberto', 'Fonzone', '2033 Hallows Alley', '3045724334', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (98, 'cboken2p', 'cboken2p@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Chandra', 'Boken', '605 Carioca Plaza', '9586223865', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (99, 'nkedge2q', 'nkedge2q@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Neville', 'Kedge', '3 Chive Trail', '1631893877', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (100, 'shartgill2r', 'shartgill2r@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Sigmund', 'Hartgill', '7453 Ryan Way', '5403554240', false, 0);
insert into "user" (idClient, username, email, password, firstName, lastName, address, phoneNumber, isBanned, balance) values (101, 'cminister1', 'cminister1@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Constantina', 'Minister', '42749 Holmberg Trail', '2536074366', false, 0);
insert into Category (idCategory, name) values (1, 'Sports');
insert into Category (idCategory, name) values (2, 'Entertainment');
insert into Category (idCategory, name) values (3, 'Vehicles');
insert into Category (idCategory, name) values (4, 'Art');
insert into Category (idCategory, name) values (5, 'Real Estate');
insert into Category (idCategory, name) values (6, 'Fashion');
insert into Category (idCategory, name) values (7, 'Technology');
insert into Category (idCategory, name) values (8, 'Home and Garden');
insert into Category (idCategory, name) values (9, 'Animals');
insert into AuctionOwner (idClient) values (1);
insert into AuctionOwner (idClient) values (2);
insert into AuctionOwner (idClient) values (3);
insert into AuctionOwner (idClient) values (4);
insert into AuctionOwner (idClient) values (5);
insert into AuctionOwner (idClient) values (6);
insert into AuctionOwner (idClient) values (7);
insert into AuctionOwner (idClient) values (8);
insert into AuctionOwner (idClient) values (9);
insert into AuctionOwner (idClient) values (10);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (1, 'Wilson Rf97 V10', '2022-09-16 15:41:15', '2023-03-14 03:01:53', 95, 95, 'Perfect condition Tennis racquet', false, 1, 1);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (2, 'Apple iPhone 13 Max Pro', '2022-09-06 18:34:14', '2023-01-23 09:42:29', 1400, 1400, 'iPhone with Factory Warranty, Novo', false, 7, 2);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (3, 'Long sleeve shirt', '2022-09-29 00:14:40', '2022-12-11 13:51:29', 14, 14, 'Red shirt in excellent condition', false, 6, 3);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (4, 'Old Oil Painting', '2022-09-02 11:32:30', '2022-12-21 16:58:51', 51, 51, 'Autumn Mountain Painting in Good Condition', false, 4, 4);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (5, 'Honda Civic', '2022-09-20 08:24:53', '2023-12-14 16:12:04', 8000, 8000, 'Honda Civic Vx 1992, second hand', false, 3, 5);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (6, 'Laser Pointer', '2022-08-05 04:26:52', '2023-12-16 06:30:09', 20, 20, 'Green Rechargable Laser Pointer 532NM', false, 2, 6);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (7, 'Samsung Galaxy S20', '2022-09-25 17:41:01', '2023-12-31 03:52:39', 1000, 1000, 'Samsung phone in good condition', false, 7, 7);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (8, 'Wood Hut', '2022-10-19 22:19:24', '2023-01-02 15:57:00', 20000, 20000, 'Wood hut, perfect for winter vacation', false, 5, 8);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (9, 'Nike Court Aerobill', '2022-10-08 11:19:21', '2023-01-27 15:00:00', 43, 43, 'Tennis hat, adult', false, 1, 9);
insert into Auction (idAuction, name , startDate, endDate, startingPrice, currentPrice, description, isOver, idCategory, idOwner) values (10, 'Digital Camera', '2022-10-02 10:18:06', '2023-01-07 17:54:09', 50, 50, 'Polaroid i20X29 20.0MP Digital Camera', false, 7, 10);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (1, '2022-10-21 00:25:00', 'true', 95, 1, 10);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (2, '2022-10-22 10:00:30', 'true', 1400, 2, 9);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (3, '2022-10-20 21:00:00', 'true', 21000, 101, 8);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (4, '2022-10-22 14:30:00', 'true', 1151, 4, 7);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (5, '2022-10-19 10:00:00', 'true', 100, 5, 6);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (6, '2022-10-18 12:10:00', 'true', 20000, 6, 5);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (7, '2022-10-15 12:00:00', 'true', 220, 7, 4);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (8, '2022-10-20 22:00:30', 'true', 200, 8, 3);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (9, '2022-10-20 21:10:25', 'true', 4312, 9, 2);
insert into Bid (idBid, bidDate, isValid, price, idClient, idAuction) values (10, '2022-10-19 13:12:10', 'true', 150, 10, 1);
insert into FavoriteAuction (idClient, idAuction) values (1, 1);
insert into FavoriteAuction (idClient, idAuction) values (2, 2);
insert into FavoriteAuction (idClient, idAuction) values (3, 3);
insert into FavoriteAuction (idClient, idAuction) values (4, 4);
insert into FavoriteAuction (idClient, idAuction) values (5, 5);
insert into FavoriteAuction (idClient, idAuction) values (6, 6);
insert into FavoriteAuction (idClient, idAuction) values (7, 7);
insert into FavoriteAuction (idClient, idAuction) values (8, 8);
insert into FavoriteAuction (idClient, idAuction) values (9, 9);
insert into FavoriteAuction (idClient, idAuction) values (10, 10);
insert into FavoriteAuction (idClient, idAuction) values (50, 1);
insert into FavoriteAuction (idClient, idAuction) values (60, 2);
insert into FavoriteAuction (idClient, idAuction) values (27, 3);
insert into FavoriteAuction (idClient, idAuction) values (23, 4);
insert into FavoriteAuction (idClient, idAuction) values (4, 5);
insert into FavoriteAuction (idClient, idAuction) values (67, 6);
insert into FavoriteAuction (idClient, idAuction) values (25, 7);
insert into FavoriteAuction (idClient, idAuction) values (87, 8);
insert into FavoriteAuction (idClient, idAuction) values (13, 9);
insert into FavoriteAuction (idClient, idAuction) values (11, 10);
insert into SystemManager (idSysMan, username , email, password) values (1, 'ljedrych0', 'ljedrych0@blogtalkradio.com', '4HmZdUZG6kV');
insert into SystemManager (idSysMan, username , email, password) values (2, 'kcollihole1', 'kcollihole1@so-net.ne.jp', 'n5gLdwK');
insert into SystemManager (idSysMan, username , email, password) values (3, 'admin', 'admin@gmail.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
insert into BanAppeals (idBanAppeal, appealDate, appealDescription, idClient) values (1, '2022-10-19 13:12:10', 'Please unban me I didnt do anything wrong', 2);
insert into BanAppeals (idBanAppeal, appealDate, appealDescription, idClient) values (2, '2022-10-19 13:12:10', 'I dont care about your stupid rules unban me now!', 3);
insert into BanAppeals (idBanAppeal, appealDate, appealDescription, idClient) values (3, '2022-10-19 13:12:10', 'It was an honest mistake, I didnt know you couldnt do that.', 4);



