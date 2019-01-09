# -*- coding: utf-8 -*-
"""
Created on Tue Jan  8 14:40:29 2019

@author: ameya
"""

import datetime
now = datetime.datetime.now()
class Account:
    def __init__(self, details, balance = 0):
        self.Transactions = []
        self.personal_details = Personal_Details(details)
        self.Balance = int(balance)
        self.Initialisation_Date = now.strftime("%d-%m-%Y")
    
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
        self.PhoneNo = details['PhoneNo']
        self.BlockNo = details['BlockNo']
        self.FlatNo = details['FlatNo']
    def get_details(self):
        detail = {}
        detail['Name'] = self.Name
        detail['PhoneNo'] = self.PhoneNo
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