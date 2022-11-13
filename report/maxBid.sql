DROP FUNCTION IF EXISTS create_bid() CASCADE;

CREATE FUNCTION create_bid() RETURNS TRIGGER AS 
DECLARE
    curr_price INTEGER;

$BODY$
BEGIN
    SELECT currentprice into curr_price FROM Auction
    WHERE(Auction.idAuction = NEW.idAuction)
    IF 
        (NEW.price < curr_price)
    THEN
        RAISE EXCEPTION 'Value of the bid is lower than the highest bid on the auction';
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;


CREATE TRIGGER create_bid
BEFORE INSERT ON Bid
FOR EACH ROW
EXECUTE PROCEDURE create_bid(); 