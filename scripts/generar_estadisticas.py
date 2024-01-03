#!/usr/local/bin/python
# -*- coding: utf-8 -*-
import json
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="precios",
    password="precios",
    database="precios"
)

cursor = conexion.cursor()

