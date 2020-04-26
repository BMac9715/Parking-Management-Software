import mysql.connector
from mysql.connector import Error
from datetime import datetime
import smtplib, ssl

# Create a secure SSL context
port = 465  # For SSL
context = ssl.create_default_context()

with smtplib.SMTP_SSL("smtp.gmail.com", port, context=context) as server:
    server.login("reddevs.url@gmail.com", "reddevs123")
    
    sender_email = "reddevs.url@gmail.com"
    message = """\
Parking Bill

Friendly reminder to pay your parking bill."""

    try:
        connection = mysql.connector.connect(host='parking-management-system-bdd.mysql.database.azure.com',
                                            database='parking',
                                            user='Harry@parking-management-system-bdd',
                                            password='devharry1234')
        if connection.is_connected():
            db_Info = connection.get_server_info()
            print("Connected to MySQL Server version ", db_Info)
            cursor = connection.cursor()
            cursor.execute("SELECT * FROM parking.clients;")
            records = cursor.fetchall()

            datetime_object = datetime.now()
            for row in records:
                if(datetime_object.day == row[5].day):
                #if(True):
                    server.sendmail(sender_email, row[6], message)

    except Error as e:
        print("Error while connecting to MySQL", e)
    finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
            print("MySQL connection is closed")