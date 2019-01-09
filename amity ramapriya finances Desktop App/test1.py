# -*- coding: utf-8 -*-
"""
Created on Sun Jan  6 13:27:04 2019

@author: ameya
"""
import time
import datetime
import sqlite3 as lite

now = datetime.datetime.now()
res_list = []
class Account:
    def __init__(self, details, balance = 0):
        self.transactions = []
        self.personal_details = Personal_Details(details)
        self.balance = int(balance)
        self.initialisation_date = now.strftime("%d-%m-%Y")
    
    def print_details(self):
        self.personal_details.print_details()
        print("Total number of Transactions: ",len(self.transactions))
        print("Date of Opening: ",self.initialisation_date)
        print("Balance: ",self.balance)
        for i in self.transactions:
            i.print_transactions()
    def get_balance(self):
        return self.balance
    def __eq__(self, other):
        return self.__dict__ == other.__dict__
    def set_balance(self, bal):
        self.balance = bal

class Personal_Details: 
    def __init__(self, details):
        self.Name = details['Name']
        self.PhoneNo = details['Phone Number']
        self.BlockNo = details['BlockNo']
        self.FlatNo = details['FlatNo']
    def get_details(self):
        detail = {}
        detail['Name'] = self.Name
        detail['Phone Number'] = self.PhoneNo
        detail['BlockNo'] = self.BlockNo
        detail['FlatNo'] = self.FlatNo
        return detail
    def print_details(self):
        print("Name: {}".format(self.Name))
        print("Flat Number: {}-{}".format(self.BlockNo, self.FlatNo))
        print("Phone Number: {}".format(self.PhoneNo))
    def get_name(self):
        return self.Name
    def get_flatno(self):
        return self.FlatNo   

class Transaction:
    def __init__(self, ac1, ac2, balance = 4000):
        self.src = ac1
        self.dest = ac2
        self.balance = balance
        self.transaction_date = now.strftime("%d-%m-%Y")
    def make_transaction(self):
        for i in res_list:
            if i == self.src:
                i.set_balance(i.get_balance() - self.balance)
                i.transactions.append(self)
            if i == self.dest:
                i.set_balance(i.get_balance() + self.balance)
                i.transactions.append(self)
        print("Transaction made successfully")
    def print_transactions(self):
        print("Source: {}".format(self.src.personal_details.get_flatno()))
        print("Destination: {}".format(self.dest.personal_details.get_flatno()))
        print("Transaction Amount: {}".format(self.balance))
        print("Tansaction Date: ".format(self.transaction_date))

def make_transation():
    fl1 = int(input("Enter source Flat"))
    fl2 = int(input("Enter destination flat"))
    for i in res_list:
        if i.personal_details.get_flatno() == fl1:
            ac1 = i
        if i.personal_details.get_flatno() == fl2:
            ac2 = i
    money = int(input("enter Money to send"))
    trans = Transaction(ac1, ac2, money)
    trans.make_transaction()
    
    
def register_resident():
    details = {}
    details['Name'] = input("Enter Resident Name: ")
    details['BlockNo'] = input("Enter Block: ")
    details['FlatNo'] = input("Enter Flat Number: ")
    details['Phone Number'] = input("Enter Resident Phone Number")
    details['FlatNo'] = int(format(int(details['FlatNo']),'03d'))
    return details
def add_res():
    Balance = input("Enter Initial Balance: ")
    res1 = Account(register_resident(), Balance)
    return res1

if __name__ == '__main__':
    #amityAC = Account(register_resident(), 300000)
    while(1):
        print("1.Add Res\n2.View Res\n3.Exit\n.4.Make transaction\n")
        ch = int(input("Enter your choice: "))
        if ch ==  1:
            res_list.append(add_res())
            print("User added successfully")
        elif ch == 2:
            for i in res_list:
                i.print_details()
        elif ch == 3:
            break
        elif ch == 4:
            make_transation()