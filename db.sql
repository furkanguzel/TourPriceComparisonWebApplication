use pricecomparison;

CREATE TABLE Websites (
	WebID INT NOT NULL AUTO_INCREMENT,
	WebName VARCHAR(30) NOT NULL,
	PRIMARY KEY (WebID)
);

INSERT INTO Websites (WebID,Webname) VALUES (1, 'www.tatilsepeti.com');
INSERT INTO Websites (WebID,Webname) VALUES (2, 'www.etstur.com');
INSERT INTO Websites (WebID,Webname) VALUES (3, 'www.tatil.com');

CREATE TABLE Hotels (
    Hotel_ID int NOT NULL AUTO_INCREMENT,
    Hotel_Name VARCHAR(30) NOT NULL,
	Hotel_Region VARCHAR(30) NOT NULL,
	Web_ID int,
    PRIMARY KEY (HotelID),
    FOREIGN KEY (Web_ID) REFERENCES Websites(WebID)
);