import sys
import smtplib

print("geldi")

mail = sys.argv[1]

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

content = "Merhaba degerli kullanicimiz, \n\nKARAGOZ EMLAK ailesine hos geldiniz. \n\nsizleri aramizda gormekten mutluluk duyuyoruz. \n\n\nDilek, sikayet ve goruslerinizi rubwally@gmail.com adresine iletebilirsiniz. "
subject = "KARAGOZ EMLAK ~ Hosgeldiniz"

sendMail(mail,subject,content)

#print(mail,password)

