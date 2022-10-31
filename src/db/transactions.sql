-------------------------------------
--       TRANSACTION CREATION       --
--------------------------------------

-- 1) Bidding
BEGIN;

SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

select Bid.idBid, Bid.bidDate, Bid.isValid, Bid.price, Bid.idClient, Bid.idAuction 
from Auction,Bid where bid.idAuction = Auction.idAuction order by Bid.price asc;
                            
COMMIT;

-- 2) New auction
BEGIN;
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

-- Get number of current auctions
SELECT COUNT(*)
FROM Auction
WHERE now() < endDate;

-- Get ending auctions (limit 8)
SELECT Auction.name, Auction.startDate, Auction.endDate, Auction.startingPrice, Auction.currentPrice, Auction.description, Category.name, Client.username 
FROM Auction 
INNER JOIN Category ON Category.idCategory = Auction.idCategory
INNER JOIN AuctionOwner ON AuctionOwner.idClient = Auction.idOwner
INNER JOIN Client ON Client.idClient = AuctionOwner.idClient
WHERE now () < Auction.endDate
ORDER BY Auction.endDate ASC
LIMIT 8;

COMMIT;
