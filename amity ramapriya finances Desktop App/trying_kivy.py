# -*- coding: utf-8 -*-
"""
Created on Tue Jan  8 09:11:59 2019

@author: ameya
"""

import kivy
kivy.require('1.10.1')

from kivy.app import App
from kivy.uix.label import Label
from kivy.uix.gridlayout import GridLayout
from kivy.uix.textinput import TextInput
from kivy.uix.widget import Widget

class customwidget(Widget):
    pass

class MyApp(App):
    def build(self):
        return customwidget()
if __name__ == '__main__':
    MyApp().run()