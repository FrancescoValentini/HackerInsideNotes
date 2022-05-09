using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;

namespace HackerInsideNotes {
    public class User {
        public string UID { get; set; }
        public CookieContainer cookieContainer { get; set; }

        public User() {
            cookieContainer = new CookieContainer();
        }

        public User(string UID, CookieContainer cookieContainer) {
            this.UID = UID;
            this.cookieContainer = cookieContainer;

        }

        public string login(string username, string password) {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_controlloLogin.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "username=" + Uri.EscapeDataString(username);
            postData += "&pwd=" + Uri.EscapeDataString(password);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


            JObject obj = JObject.Parse(responseString);
            

            this.UID = (string)obj["uid"];

            return responseString;
        }

        public List<Nota> getNotes() {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_getNotes.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "uid=" + Uri.EscapeDataString(this.UID);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


            return JsonSerializer.Deserialize<List<Nota>>(responseString);
        }

        public Nota getNote(string noteID) {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_getNotes.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "noteID=" + Uri.EscapeDataString(noteID);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();

            return JsonSerializer.Deserialize<Nota>(responseString);
        }
        public String addNote(string title,string nota) {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_addNote.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "titolo=" + Uri.EscapeDataString(title);
            postData += "&nota=" + Uri.EscapeDataString(nota);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


            JObject obj = JObject.Parse(responseString);


            return (string)obj["errorcode"];
        }
        public String deleteNote(string noteID) {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_deleteNote.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "noteID=" + Uri.EscapeDataString(noteID);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


            JObject obj = JObject.Parse(responseString);


            return (string)obj["errorcode"];
        }

        public String editNote(string noteID, string title, string nota) {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_editNote.php");

            request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

            var postData = "noteID=" + Uri.EscapeDataString(noteID);
            postData += "&titolo=" + Uri.EscapeDataString(title);
            postData += "&nota=" + Uri.EscapeDataString(nota);
            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream()) {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


            JObject obj = JObject.Parse(responseString);


            return (string)obj["errorcode"];
        }
    }
}
