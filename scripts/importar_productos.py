import json
import mysql.connector
from datetime import datetime, timedelta

fecha_actual = datetime.now().strftime("%Y-%m-%d")

# Establecer la conexión con la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="precios",
    password="precios",
    database="precios"
)

# Realizar operaciones en la base de datos
# Por ejemplo, ejecutar una consulta SQL
cursor = conexion.cursor()

productos_existentes = []
productos_erroneos = []
precios_existentes = []
registros_agregados = []
precios_cambiados = []
fecha_ultimo_precio_upd = []

def agregar_precio(cursor, reg):
    text_nuevo_precio = "Se agregó nuevo precio - Carga Masiva - "+reg['name']+" - "+str(reg['price'])
    cursor.execute("INSERT INTO price (product_id, price, date_time, branch_id, es_oferta, confiabilidad) VALUES (%s, %s, %s, %s, %s, %s)", (id_producto, reg['price'], fecha_actual, reg['branch_id'], 0, 100))
    cursor.execute("INSERT INTO news (text, datetime, type_id) VALUES (%s, %s, %s)", (text_nuevo_precio, fecha_actual, 1))
          
with open('tmp/productos.json') as archivo_json:
    precios = json.load(archivo_json)

for reg in precios:
    print(reg)
    #Buscamos en la base de datos en la tabla products si existe un producto con el mismo nombre
    cursor.execute("SELECT * FROM products WHERE name =  %s", (str(reg['name']),))
    resultados = cursor.fetchall()

    if reg['category'] == -1 or reg['branch_id'] == -1:
        print("Producto con categoria o local erroneo")
        productos_erroneos.append(reg)
        continue

    if len(resultados) == 0:
        cursor.execute("INSERT INTO products (name, vendor_id, ultimo_precio_conocido) VALUES (%s, %s, %s)", (reg['name'], reg['vendor_id'], fecha_actual))
        id_producto_agregado = cursor.lastrowid
        cursor.execute("INSERT INTO product_category (product_id, category_id) VALUES (%s, %s)", (id_producto_agregado, reg['category']))
        
        text_nuevo_precio = "Se agregó nuevo precio - Carga Masiva - "+reg['name']+" - "+str(reg['price'])
        cursor.execute("INSERT INTO price (product_id, price, date_time, branch_id, es_oferta, confiabilidad) VALUES (%s, %s, %s, %s, %s, %s)", (id_producto_agregado, reg['price'], fecha_actual, reg['branch_id'], 0, 100))
        cursor.execute("INSERT INTO news (text, datetime, type_id) VALUES (%s, %s, %s)", (text_nuevo_precio, fecha_actual, 1))
        print("Se inserto el producto")
        registros_agregados.append(reg)
        
    else:
        print("El producto ya existe")
        cursor.execute("SELECT * FROM products WHERE name =  %s", (str(reg['name']),))
        resultados = cursor.fetchone()
        id_producto = resultados[0]
        cursor.execute("UPDATE products SET ultimo_precio_conocido = %s WHERE id = %s", (fecha_actual, id_producto))
        cursor.execute("SELECT * FROM price WHERE product_id = %s and branch_id = %s AND confiabilidad > 90 ORDER BY date_time DESC LIMIT 1  ", (id_producto, reg['branch_id']))
        resultados = cursor.fetchone()
        
        if (resultados == None):
            print('No se encontro precio, se agrega')
            agregar_precio(cursor, reg)
            registros_agregados.append(reg)
        else:
            if not resultados[2] == reg['price']:
                precios_cambiados.append(reg)
                agregar_precio(cursor, reg)
                text_nuevo_precio = "Se actualiza precio - Carga Masiva - "+reg['name']+" - "+str(reg['price'])
                cursor.execute("INSERT INTO news (text, datetime, type_id) VALUES (%s, %s, %s)", (text_nuevo_precio, fecha_actual, 1))
            else:
                print('Ya existe un precio para ese articulo en ese local, se actualiza la fecha')
                text_nuevo_precio = "Se reafirma precio - Carga Masiva - "+reg['name']+" - "+str(reg['price'])
                cursor.execute("INSERT INTO news (text, datetime, type_id) VALUES (%s, %s, %s)", (text_nuevo_precio, fecha_actual, 1))
                fecha_ultimo_precio_upd.append(reg)
            precios_existentes.append(reg)

        productos_existentes.append(reg)

#conexion.commit()

for producto in productos_existentes:
    print(producto)

print("Cantidad productos existentes: ", len(productos_existentes))
print("Cantidad total de precios: ", len(precios))
print("Cantidad registros erroneos: ", len(productos_erroneos))
print("Cantidad registros de precios existentes en local: ", len(precios_existentes))
print("Cantidad registros de precios agregados: ", len(registros_agregados))
print("Cantidad de precios cambiados: ", len(precios_cambiados))
print("Cantidad de precios en los que se actualizó su fecha de ultimo precio conocido: ", len(fecha_ultimo_precio_upd))
# Cerrar la conexión con la base de datos
conexion.close()