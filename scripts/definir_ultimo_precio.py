import mysql.connector
from datetime import datetime, timedelta

conexion = mysql.connector.connect(
    host="localhost",
    user="precios",
    password="precios",
    database="precios"
)

cursor = conexion.cursor()

cursor.execute("SELECT * FROM products")
resultados = cursor.fetchall()

for producto in resultados:
    print(producto)
    id_producto = producto[0]
    print(id_producto)

    cursor.execute("SELECT * FROM price WHERE product_id = %s ORDER BY date_time DESC LIMIT 1", (id_producto,))
    ultimo_precio = cursor.fetchone()
    
    if ultimo_precio != None:
        ultimo_precio = ultimo_precio[3]
        print('Fecha ultimo precio',ultimo_precio)

        sql = "UPDATE products SET ultimo_precio_conocido = %s WHERE id = %s"
        cursor.execute(sql, (ultimo_precio, id_producto,))
    
conexion.commit()