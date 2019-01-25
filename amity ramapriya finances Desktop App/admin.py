# -*- coding: utf-8 -*-
"""
Created on Tue Jan  8 14:39:19 2019

@author: ameya
"""

import sqlite3
import datetime
import kivy
kivy.require("1.10.1")
from kivy.app import App
from kivy.uix.screenmanager import Screen, ScreenManager
from kivy.lang.builder import Builder
from kivy.properties import ObjectProperty, ListProperty, BooleanProperty
from kivy.uix.popup import Popup
from kivy.uix.listview import ListView
from kivy.uix.recycleview import RecycleView
from kivy.uix.recycleboxlayout import RecycleBoxLayout
from kivy.uix.recyclegridlayout import RecycleGridLayout
from kivy.uix.recycleview.views import RecycleDataViewBehavior
from kivy.uix.label import Label

conn = sqlite3.connect('Amity Ramapriya Finances.db')
c = conn.cursor()
now = datetime.datetime.now()
Builder.load_file("ARAFin.kv")
# DATABASE STORAGE AND MANIPULATION FUNCTIONS FOR RESIDENTS
def create_table_accounts():
    with conn:
        c.execute("""CREATE TABLE Accounts (
                Name TEXT,
                PhoneNo INTEGER,
                BlockNo TEXT,
                FlatNo INTEGER ,
                Balance REAL,
                Initialisation_Date TEXT,
                Transactions TEXT
                )""")

def create_table_transactions():
    with conn:
        c.execute("""CREATE TABLE Transactions(
                    T_ID INT PRIMARY KEY AUTO_INCREMENT,
                    From INTEGER,
                    To INTEGER,
                    Amount REAL,
                    Transaction_Date TEXT,
                    Mode TEXT
                    )""")
def add_new_res(details):
    with conn:
        c.execute("INSERT INTO Accounts VALUES (:Name, :PhoneNo, :BlockNo, :FlatNo, :Balance, :Initialisation_Date, :Transactions)", details)

def update_res(details):
    with conn:
        c.execute("""UPDATE Accounts
                     SET Name = ?, PhoneNo = ?, BlockNo = ?, Balance = ?
                     WHERE FlatNo = ?""", (details['Name'], details['PhoneNo'], details['BlockNo'], details['Balance'], details['FlatNo']))
def view_res():
    with conn:
        c.execute("SELECT Name, PhoneNo, BlockNo, FlatNo, Balance FROM Accounts")
        rows = c.fetchall()
        print(rows)
    return rows
        
def delete_res(flatNo):
    with conn:
        c.execute("""DELETE FROM Accounts WHERE FlatNo = ?""", (flatNo,))
# END OF DATABASE STORAGE AND MANIPULATION FUNCTIONS FOR RESIDENTS

#HOME SCREEN DEFINITION
class HomeScreen(Screen):
    pass
#Failed user register popup
class FailRegisterPopup(Popup):
    pass

class SuccessRegisterPopup(Popup):
    pass

#ADD RESIDENT DEFINITION
class AddResidentScreen(Screen):
    nameRes = ObjectProperty()
    phoneNo = ObjectProperty()
    blockNo = ObjectProperty()
    flatNo = ObjectProperty()
    balance = ObjectProperty()
    errorname = ObjectProperty()
    errorphno = ObjectProperty()
    errorblockno = ObjectProperty()
    errorflatno = ObjectProperty()
    errorbalance = ObjectProperty()
    
    def reset_errors(self):
        self.errorname.text = ""
        self.errorphno.text = ""
        self.errorblockno.text = ""
        self.errorflatno.text = ""
        self.errorbalance.text = ""
    def reset_text_input(self):
        self.nameRes.text = ""
        self.phoneNo.text = ""
        self.blockNo.text = ""
        self.flatNo.text = ""
        self.balance.text = "" 
    def validate_input(self, details):
        validate_dict = {'Name': True, 'PhoneNo': True, 'FlatNo': True, 'Balance': True, 'BlockNo': True}
        valid_blocks = ['A', 'B', 'C']
        if len(details['Name']) == 0:
            validate_dict['Name'] = False
        if str(details['PhoneNo']).isdigit() == False:
            validate_dict['PhoneNo'] = False
        elif len(str(details['PhoneNo'])) != 10:
            validate_dict['PhoneNo'] = False
        if details['BlockNo'].upper() not in valid_blocks:
            validate_dict['BlockNo'] = False
        fno = str(details['FlatNo'])
        if len(fno) != 3:
            validate_dict['FlatNo'] = False
        elif fno.isdigit() == False:
            validate_dict['FlatNo'] = False
        elif int(fno[0]) > 4 or int(fno[0]) < 0:
            validate_dict['FlatNo'] = False
        elif int(fno[1:3]) > 12 or int(fno[1:3]) < 0:
            validate_dict['FlatNo'] = False
        if details['Balance'] == "":
            validate_dict['Balance'] = False
        elif details['Balance'].isdigit() == False:
            validate_dict['Balance'] = False
        elif float(details['Balance']) < 0:
            validate_dict['Balance'] = False
        return validate_dict
   
    def submit(self):
        all_ok = True
        self.reset_errors()
        details = {}
        details['Name'] = self.nameRes.text.rstrip()
        details['PhoneNo'] = self.phoneNo.text.rstrip()
        details['BlockNo'] = self.blockNo.text.rstrip()
        details['FlatNo'] = self.flatNo.text.rstrip()
        details['Balance'] = self.balance.text.rstrip()
        details['Initialisation_Date'] = now.strftime("%d-%m-%Y")
        details['Transactions'] = ""
        validated = self.validate_input(details)
        if not validated['Name']:
            self.errorname.text = "Please Enter Correct Name"
            all_ok = False
        if not validated['PhoneNo']:
            self.errorphno.text = "Enter a valid Phone Number"
            all_ok = False
        if not validated['BlockNo']:
            self.errorblockno.text = "Enter Valid Block"
            all_ok = False
        if not validated['FlatNo']:
            self.errorflatno.text = "Enter Valid Flat no"
            all_ok = False
        if not validated['Balance']:
            self.errorbalance.text = "Enter valid Balance"
            all_ok = False
        if all_ok:
            details['FlatNo'] = int(details['FlatNo'])
            details['Balance'] = float(details['Balance'])
            details['PhoneNo'] = int(details['PhoneNo'])
            c.execute("SELECT *FROM Accounts WHERE FlatNo = ?",(details['FlatNo'],))
            rows = c.fetchall()
            if len(rows) == 1:
                print("Resident Details already exists")
                popupmsg = FailRegisterPopup()
                popupmsg.open()
                
            else:
                add_new_res(details)
                successpopup = SuccessRegisterPopup()
                successpopup.open()
                self.reset_text_input()
                self.reset_errors()
                print("Resident added")
                #root.manager.current = "Home"
#DATATTYPES OF BALANCE AND FLAT NO HAVE TO BE CHANGED
class SelectableLabel(Label):
    ''' Add selection support to the Label '''
    pass
    
class ViewRegisteredResidentsScreen(Screen):
    data_items = ListProperty([])
    def __init__(self, **kwargs):
        super(ViewRegisteredResidentsScreen, self).__init__(**kwargs)
        self.loaddataintolist()
    def loaddataintolist(self):
        rows = view_res()
        for row in rows:
            for col in row:
                self.data_items.append(col)
        
        
               
class Screen_Manager(ScreenManager):
    pass
app = Screen_Manager()
app.add_widget(HomeScreen())
app.add_widget(AddResidentScreen())
app.add_widget(ViewRegisteredResidentsScreen(name = "viewres"))
class ARAFinaApp(App):
    def build(self):
        return app
    
if __name__ == '__main__':
    Finances = ARAFinaApp()
    Finances.run()