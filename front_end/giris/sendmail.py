import sys
import smtplib

mail = sys.argv[1]
password = sys.argv[2]
#islem = sys.argv[3]


def sendMail(to="", sub="", content=""):
    if (to == "" and content == "" and sub == ""):
        to = input("SEND TO >> ")
        sub = input("SUBJECT >> ")
        content = input("CONTENT >> ")
    mail = smtplib.SMTP("smtp.gmail.com", 587)
    mail.ehlo()
    mail.starttls()
    mail.login("rubwally@gmail.com", "donttouchthefunc")
    content = 'Subject: {}\n\n{}'.format(sub, content)
    mail.sendmail("rubwally@gmail.com", to, content)
    print("mail gonderildi.")


content = "Merhaba degerli kullanicimiz,\n\n KARAGOZ EMLAK kullanici sifreniz =  "+password
subject = "KARAGOZ EMLAK - Sifre Hatirlatma"

sendMail(mail,subject,content)

#print(mail,password)

