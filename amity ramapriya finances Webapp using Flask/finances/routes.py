from flask import render_template, url_for, redirect
from finances import app, db
from finances.forms import RegisterAccount, MonthlyIncome
from finances.models import Account


@app.route("/")
def home():
    return render_template('homepage.html')

@app.route("/AddAccount", methods=['GET', 'POST'])
def add_accounts():
    forms = RegisterAccount()
    acc_types = ['Resident', 'Payment', 'Expense','Others']
    if forms.validate_on_submit():
        print('submitted')
        acc = Account(holder_name = forms.CustomerName.data,
                      account_type = forms.AccountType.data,
                      block_no = forms.BlockNo.data,
                      flat_no = forms.FlatNo.data,
                      phone_no = forms.PhoneNo.data,
                      balance = float(forms.Balance.data))
        db.session.add(acc)
        db.session.commit()
        return redirect(url_for('home'))
    return render_template('addacc.html', title="Add Account", form = forms, acc_type = acc_types)
@app.route("/MonthlyIncome", methods=['GET', 'POST'])
def monthly_income():
    forms = MonthlyIncome()
    noofres = len(Account.query.all())
    return render_template('monthlyinc.html', title = "Monthly Resident Income", form = forms, noofres = noofres)


