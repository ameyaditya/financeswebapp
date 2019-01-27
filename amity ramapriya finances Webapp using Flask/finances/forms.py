from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, IntegerField, DecimalField, SelectField, BooleanField
from wtforms.validators import DataRequired, Length, NumberRange, Optional
from finances import db
from finances.models import Account

class RegisterAccount(FlaskForm):
    CustomerName = StringField('Enter Resident Name', 
                               validators= [DataRequired()])
    AccountType = SelectField("Enter Account Type", validators=[DataRequired()], choices = [('Resident','Resident'), ('Payment','Payment'), ('Expense', 'Expense'),('Others','Others')])
    BlockNo = StringField('Enter Block Number',
                          validators= [Length(min=1, max =1), Optional()])
    FlatNo = IntegerField('Enter Flat Number',
                          validators= [NumberRange(min = 1, max= 412),Optional()])
    PhoneNo = StringField('Enter Phone Number',
                          validators=[DataRequired(), Length(min = 10, max = 10)])
    Balance = DecimalField("Enter Balance in Account", validators=[DataRequired()])
    Submit = SubmitField('Submit')

class MonthlyIncome(FlaskForm):
    Residents = Account.query.all()
    resident = {}
    i = 1
    for res in Residents:
        exec('res_{0} = BooleanField("{1}")'.format(str(i), res.flat_no))
        i += 1
    Submit = SubmitField('Submit')
    
        
        
    
    
    
    
    