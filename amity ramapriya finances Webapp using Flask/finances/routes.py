from flask import render_template, url_for, redirect
from finances import app, db
from finances.forms import RegisterResident
from finances.models import Account


@app.route("/")
def home():
    return render_template('homepage.html')

@app.route("/AddResident", methods=['GET', 'POST'])
def add_res():
    forms = RegisterResident()
    if forms.validate_on_submit():
        acc = Account(holder_name = forms.ResidentName.data,
                      block_no = forms.BlockNo.data,
                      flat_no = int(forms.FlatNo.data),
                      phone_no = forms.PhoneNo.data,
                      balance = float(forms.Balance.data))
        db.session.add(acc)
        db.session.commit()
        return redirect(url_for('home'))
    return render_template('addres.html', title="Add Resident", form = forms)


