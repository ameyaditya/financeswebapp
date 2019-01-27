from datetime import datetime
from finances import db
                
class Account(db.Model):
    account_id = db.Column(db.Integer, primary_key=True)
    holder_name = db.Column(db.String(30), nullable=False)
    account_type = db.Column(db.String(20), nullable=False, default='Resident')
    block_no = db.Column(db.String(1), nullable=True)
    phone_no = db.Column(db.String(10), nullable=False)
    flat_no = db.Column(db.Integer, nullable=True, unique=True)
    balance = db.Column(db.Float, default=0.0, nullable=False)
    transactions = db.relationship('Transactions', backref='ref_acc', lazy=True)
    init_date = db.Column(db.DateTime, nullable=False, default=datetime.utcnow)
    
    
    def __repr__(self):
        return "Account('{}', '{}', '{}')".format(self.account_id, self.account_type, self.holder_name)
    

class Transactions(db.Model):
    trans_id = db.Column(db.Integer, primary_key=True)
    trans_user = db.Column(db.Integer, db.ForeignKey('account.account_id'), nullable=False )
    trans_amount = db.Column(db.Float, nullable= False)
    trans_date = db.Column(db.DateTime, nullable=False, default = datetime.utcnow)
    trans_mode = db.Column(db.String(10), nullable=False)
    trans_type = db.Column(db.String(10), nullable=False)
    trans_descr = db.Column(db.Text)
    
    def __repr__(self):
        return "Transcation('{}', '{}', '{}')".format(self.trans_id, self.trans_user, self.trans_mode)
    
    