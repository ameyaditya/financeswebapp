from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField, IntegerField, DecimalField
from wtforms.validators import DataRequired, Length, NumberRange

class RegisterResident(FlaskForm):
    ResidentName = StringField('Enter Resident Name', 
                               validators= [DataRequired()])
    BlockNo = StringField('Enter Block Number',
                          validators= [DataRequired(), Length(min=1, max =1)])
    FlatNo = IntegerField('Enter Flat Number',
                          validators= [DataRequired(), NumberRange(min = 1, max= 412) ])
    PhoneNo = StringField('Enter Phone Number',
                          validators=[DataRequired(), Length(min = 10, max = 10)])
    Balance = DecimalField("Enter Balance in Account", validators=[DataRequired()])
    Submit = SubmitField('Submit')
    
    