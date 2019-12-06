DELIMITER $$
CREATE TRIGGER updatebalances
AFTER INSERT
ON `transaction` FOR EACH ROW
BEGIN
	UPDATE accounts SET Balance = Balance - NEW.Amount WHERE Account_no = NEW.From_acc;
	UPDATE accounts SET Balance = Balance + NEW.Amount WHERE Account_no = NEW.To_acc;
END ;
$$
DELIMITER ;
