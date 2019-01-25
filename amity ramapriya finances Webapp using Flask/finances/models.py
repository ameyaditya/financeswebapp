from datetime import datetime
from finances import db
creditss = db.Table('credit',
                  db.Column('account_id', db.Integer, db.ForeignKey('account.account_id')),
                  db.Column('trans_id', db.Integer, db.ForeignKey('transactions.trans_id'))
                  )
debits = db.Table('debit',
                  db.Column('account_id', db.Integer, db.ForeignKey('account.account_id')),
                  db.Column('trans_id', db.Integer, db.ForeignKey('transactions.trans_id'))
                  )
                
class Account(db.Model):
    account_id = db.Column(db.Integer, primary_key=True)
    holder_name = db.Column(db.String(30), nullable=False)
    account_type = db.Column(db.String(20), nullable=False, default='Resident')
    block_no = db.Column(db.String(1), nullable=True)
    phone_no = db.Column(db.String(10), nullable=False)
    flat_no = db.Column(db.Integer, nullable=True, unique=True)
    balance = db.Column(db.Float, default=0.0, nullable=False)
    credit = db.relationship('Transactions', secondary=creditss, backref=db.backref('trans_to', lazy = 'dynamic'))
    debit = db.relationship('Transactions', secondary=debits, backref=db.backref('trans_from', lazy = 'dynamic'))
    transactions_credit = db.relationship('Transactions', backref='resident', ForeignKey=['Transactions.trans_to'], lazy=True)
    transactions_debit = db.relationship('Transactions', backref='resident', ForeignKey=['Transactions.trans_from'], lazy=True)
    
    
    def __repr__(self):
        return "Account('{}', '{}', '{}')".format(self.account_id, self.account_type, self.holder_name)
    

class Transactions(db.Model):
    trans_id = db.Column(db.Integer, primary_key=True)
    #trans_from = db.Column(db.Integer, db.ForeignKey('account.account_id'), nullable=False)
    #trans_to = db.Column(db.Integer, db.ForeignKey('account.account_id'), nullable=False)
    trans_amount = db.Column(db.Float, nullable= False)
    trans_date = db.Column(db.DateTime, nullable=False, default = datetime.utcnow)
    trans_mode = db.Column(db.String(10), nullable=False)
    trans_descr = db.Column(db.Text)
    
    def __repr__(self):
        return "Transcation('{}', '{}', '{}')".format(self.trans_id, self.trans_from, self.trans_to)
    
    