# -*- coding: utf-8 -*-
"""
Created on Tue Jan  8 10:24:34 2019

@author: ameya
"""

import kivy
kivy.require("1.10.1")

from kivy.app import App
from kivy.uix.gridlayout import GridLayout
from kivy.uix.boxlayout import BoxLayout
from kivy.core.window import Window

Window.maximize()

class Amity_Ramapriya_finances(GridLayout):
    pass

    
class MyApp(App):
    def build(self):
        return Amity_Ramapriya_finances()
if __name__ == '__main__':
    MyApp().run()