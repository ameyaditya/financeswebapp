import sqlite3
from random import randint
from datetime import datetime
from flask import Flask, render_template, request

app = Flask(__name__)
def initialsetup():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	c.execute('''CREATE TABLE IF NOT EXISTS accounts
		(ID INTEGER PRIMARY KEY AUTOINCREMENT,
		accountno CHAR(20) NOT NULL UNIQUE,
		name CHAR(50) NOT NULL,
		email CHAR(50),
		phone CHAR(15),
		flat CHAR(5),
		block CHAR(5),
		amount FLOAT NOT NULL,
		type CHAR(20) NOT NULL)
		''')
	c.execute('''CREATE TABLE IF NOT EXISTS mainaccount
		(ID INTEGER PRIMARY KEY AUTOINCREMENT,
		accountno CHAR(20) NOT NULL UNIQUE,
		name CHAR(50) NOT NULL,
		total FLOAT NOT NULL,
		cash FLOAT NOT NULL,
		account FLOAT NOT NULL,
		tk INTEGER NOT NULL,
		fh INTEGER NOT NULL,
		th INTEGER NOT NULL,
		oh INTEGER NOT NULL,
		fy INTEGER NOT NULL,
		ty INTEGER NOT NULL,
		tn INTEGER NOT NULL,
		fe INTEGER NOT NULL,
		tw INTEGER NOT NULL,
		oe INTEGER NOT NULL)
		''')
	c.execute('''CREATE TABLE IF NOT EXISTS transactions
		(ID INTEGER PRIMARY KEY AUTOINCREMENT,
		dot TIMESTAMP NOT NULL,
		itinerary CHAR(100) NOT NULL,
		amount DOUBLE NOT NULL,
		fromacc CHAR(20) NOT NULL,
		toacc CHAR(20) NOT NULL,
		voucherno CHAR(20) NOT NULL,
		mode CHAR(15) NOT NULL,
		description CHAR(200) NOT NULL,
		comments CHAR(1000))
		''')		
	conn.commit()
	c.close()
	conn.close()
class MainAccount:
	def __init__(self):
		conn = sqlite3.connect("databases/finances.db")
		c = conn.cursor()
		c.execute('SELECT *FROM mainaccount WHERE `ID` ="1"')
		data = c.fetchone()
		print(data)
		self.ID, self.accountno, self.name, self.total, self.cash, self.account, self.twok, self.fiveh, self.twoh, self.oneh, self.fifty, self.twenty, self.ten, self.five, self.two, self.one = data
		c.close()
		conn.close()

	def transaction(self, details):
		conn = sqlite3.connect("databases/finances.db")
		c = conn.cursor()
		self.transamount = details.get('amount', 0)
		self.transfrom = details.get('from', None)
		self.transto = details.get('to', None)
		self.mode = details.get('mode', "AC")
		self.description = details.get('description', None)
		self.comments =details.get('comments', "")
		self.itinerary = details.get('itinerary', "")
		self.transdate = details.get('date', datetime.now())
		self.voucherno = details.get('voucherno', None)
		if self.mode.lower() == "cash":
			self.transdeno = details.get('denominations', dict())
		c.execute('''INSERT INTO transactions(dot, itinerary, amount, fromacc, toacc, voucherno, mode, description, comments) 
			VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?)
			''',(self.transdate, self.itinerary, self.transamount, self.transfrom, self.transto, self.voucherno, self.mode, self.description, self.comments))
		if self.transfrom == self.accountno:
			c.execute('''UPDATE accounts SET
				amount = amount + ?
				WHERE accountno = ?
				''',(self.transamount, self.transto))
			if self.mode.lower() == "cash":
				c.execute('''UPDATE mainaccount SET 
					total = total - ?,
					cash = cash - ?,
					tk = tk - ?,
					fh = fh - ?,
					th = th - ?,
					oh = oh - ?,
					fy = fy - ?,
					ty = ty - ?,
					tn = tn - ?,
					fe = fe - ?,
					tw = tw - ?,
					oe = oe - ?
					WHERE ID = "1"
					''', (self.transamount, self.transamount, self.transdeno['tk'], self.transdeno['fh'], self.transdeno['th'], self.transdeno['oh'], self.transdeno['fy'], self.transdeno['ty'], self.transdeno['tn'], self.transdeno['fe'], self.transdeno['tw'], self.transdeno['oe']))
			else:
				c.execute('''UPDATE mainaccount SET
					total = total - ?,
					account = account - ?
					WHERE ID = "1"
					''', (self.transamount, self.transamount))
		else:
			c.execute('''UPDATE accounts SET
				amount = amount - ?
				WHERE accountno = ?
				''',(self.transamount, self.transfrom))
			if self.mode.lower() == "cash":
				c.execute('''UPDATE mainaccount SET 
					total = total + ?,
					cash = cash + ?,
					tk = tk + ?,
					fh = fh + ?,
					th = th + ?,
					oh = oh + ?,
					fy = fy + ?,
					ty = ty + ?,
					tn = tn + ?,
					fe = fe + ?,
					tw = tw + ?,
					oe = oe + ?
					WHERE ID = "1"
					''', (self.transamount, self.transamount, self.transdeno['tk'], self.transdeno['fh'], self.transdeno['th'], self.transdeno['oh'], self.transdeno['fy'], self.transdeno['ty'], self.transdeno['tn'], self.transdeno['fe'], self.transdeno['tw'], self.transdeno['oe']))
			else:
				c.execute('''UPDATE mainaccount SET
					total = total + ?,
					account = account + ?
					WHERE ID = "1"
					''', (self.transamount, self.transamount))
		conn.commit()
		c.close()
		conn.close()

		
class Account:
	def __init__(self, data):
		conn = sqlite3.connect("databases/finances.db")
		c = conn.cursor()
		self.name = data.get('name', None)
		self.email = data.get('email', None)
		self.phone = data.get('phone', None)
		self.flat = data.get('flat', None)
		self.block = data.get('block', None)
		self.amount = data.get('amount', 0)
		self.type = data.get('type', None)
		self.accountno = 'ARA' + self.name[:3].upper() + str(randint(100001, 999999))
		c.execute('''INSERT INTO accounts(accountno, name, email, phone, flat, block, amount, type) VALUES
			(?, ?, ?, ?, ?, ?, ?, ?)
			''', (self.accountno, self.name, self.email, self.phone, self.flat, self.block, self.amount, self.type))
		conn.commit()
		c.close()
		conn.close()
@app.route('/')
def indexpage():
	initialsetup()
	mainobj = MainAccount()
	apartmentAccountNumber = mainobj.accountno
	return render_template("index.html")

@app.route('/addacc', methods=['POST'])
def addacc():
	details = request.form
	data = details.to_dict(flat = True)
	if data['block'] == "Select an option":
		data['block'] = None
	if data['flat'] == "":
		data['flat'] = None
	a = Account(data)
	return "true"

@app.route("/viewfilter", methods=['POST'])
def viewfilter():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	details = request.form
	if details['filter'] == 'All':
		c.execute('''SELECT accountno, type, name, email, phone, flat, block FROM accounts''')
	else:
		c.execute('''SELECT accountno, type, name, email, phone, flat, block FROM accounts WHERE type=?''',(details["filter"].split("-")[1].lstrip().rstrip() ,))
	data = c.fetchall()
	code = ""
	c.close()
	conn.close()
	for acno, types, name, email, phone, flat, block in data:
		code += "<tr><td>{0}</td><td>{1}</td><td>{2}</td><td>{3}</td><td>{4}</td>".format(acno, types, name, email, phone)
		if block == None:
			code += "<td></td>"
		else:
			code += "<td>{}-{}</td>".format(block, flat)
		code += "</tr>"
	return code

@app.route('/viewaccount')
def viewaccount():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	c.execute('''SELECT accountno, type, name, email, phone, flat, block FROM accounts''')
	data = c.fetchall()
	c.close()
	conn.close()
	return render_template("viewaccount.html", data = data)

@app.route('/viewtransaction')
def viewtransaction():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	c.execute('''SELECT ID, dot, itinerary, fromacc, toacc, mode, amount, voucherno, description FROM transactions''')
	data = c.fetchall()
	uniqueyears = []
	for i in range(len(data)):
		data[i] = list(data[i])
		data[i][1] = data[i][1].split()[0]
		uniqueyears.append(data[i][1].split("-")[0])
	uniqueyears = set(uniqueyears)
	c.execute('''SELECT flat,block FROM accounts WHERE type="Resident"''')
	data2 = c.fetchall()
	c.close()
	conn.close()
	return render_template('viewtransaction.html', data = data, fdata = data2, uniqueyears = uniqueyears)
@app.route('/addexp', methods=['POST'])
def addexp():
	details = request.form
	data = details.to_dict(flat = True)
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	now = datetime.now().strftime("%b").upper()
	c.execute('''SELECT accountno FROM accounts WHERE name=?''', (data['name'].split("-")[1],))
	c.close()
	conn.close()
	expaccountno = c.fetchone()[0]
	mn = MainAccount()
	data['from'] = mn.accountno
	data['to'] = expaccountno
	data['denominations'] = {"tk": data['tk'], "fh": data['fh'], "th": data['th'], "oh": data['oh'], "fy":data['fy'], "ty":data['ty'], "tn": data['tn'], "fe":data['fe'], "tw":data['tw'], "oe":data['oe']}
	mn.transaction(data)
	return "true"


@app.route('/addinc', methods=['POST'])
def addinc():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	details = request.form
	now = datetime.now()
	c.execute('''SELECT accountno FROM accounts WHERE flat=? AND block=?''', (details['from'].split('-')[1], details['from'].split('-')[0]))
	
	res_accountno = c.fetchone()[0]
	c.close()
	conn.close()
	data = details.to_dict(flat = True)
	mn = MainAccount()
	data['to'] = mn.accountno
	data['description'] = "Maintainance Amount "+data['from']
	data['voucherno'] = data['from'].split("-")[1] + "-" + now.strftime("%b").upper()
	print(data['voucherno'])
	data['from'] = res_accountno
	data['itinerary'] = "Maintainance Amount" 
	data['denominations'] = {"tk": data['tk'], "fh": data['fh'], "th": data['th'], "oh": data['oh'], "fy":data['fy'], "ty":data['ty'], "tn": data['tn'], "fe":data['fe'], "tw":data['tw'], "oe":data['oe']}
	mn.transaction(data)
	#details['to'] = mn.accountno
	return "true"

@app.route('/addexpenditure')
def addexpenditure():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	c.execute('''SELECT name,type FROM accounts WHERE type in ("Expense", "Payment")''')
	data = c.fetchall()
	return render_template("addexpenditure.html", data=data)

@app.route('/addaccount')
def addaccount():
	return render_template("addaccount.html")

@app.route('/addincome')
def addincome():
	conn = sqlite3.connect("databases/finances.db")
	c = conn.cursor()
	c.execute('''SELECT flat,block FROM accounts WHERE type="Resident"''')
	data = c.fetchall()
	for row in data:
		print(row)
	c.close()
	conn.close()
	return render_template("addincome.html", data = data)
if __name__ == '__main__':
	#details = {"amount": 4000, "from":"ARAAME954189", "to":apartmentAccountNumber, "description":"Resident Maintainance", "comments":"Maintainance amount from house number 212", "itinerary": "Resident", "voucherno":"ABCD1234"}
	app.run(debug = True)