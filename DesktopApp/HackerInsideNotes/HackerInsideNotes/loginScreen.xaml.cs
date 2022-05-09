using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace HackerInsideNotes {
    /// <summary>
    /// Logica di interazione per loginScreen.xaml
    /// </summary>
    public partial class loginScreen : Window {
        public loginScreen() {
            InitializeComponent();
            txtbServer.Text = Properties.Settings.Default.serverUrl;
            txtbUsername.Text = Properties.Settings.Default.serverUrl;
        }

        private void Button_Click(object sender, RoutedEventArgs e) {

            MainWindow.utenteLoggato.login(txtbUsername.Text, txtbPassword.Password.ToString());

            if(MainWindow.utenteLoggato.UID != "-1") {
                MessageBox.Show("LOGIN OK");
                new MainWindow().Show();
                Close();
            } else {
                MessageBox.Show("Wrong username or password!");
            }

            //MainWindow.utenteLoggato.login("admin", "admin");
            /* var request = (HttpWebRequest)WebRequest.Create("http://localhost/hackerinsidenotes/Backend/srv_controlloLogin.php");

             request.CookieContainer = MainWindow.utenteLoggato.cookieContainer;

             var postData = "username=" + Uri.EscapeDataString(txtbUsername.Text);
             postData += "&pwd=" + Uri.EscapeDataString(txtbPassword.Password.ToString().Trim());
             var data = Encoding.ASCII.GetBytes(postData);

             request.Method = "POST";
             request.ContentType = "application/x-www-form-urlencoded";
             request.ContentLength = data.Length;

             using (var stream = request.GetRequestStream()) {
                 stream.Write(data, 0, data.Length);
             }

             var response = (HttpWebResponse)request.GetResponse();

             var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


             txtbServer.Text = responseString;// txtbPassword.Password.ToString().Trim();

             JObject obj = JObject.Parse(responseString);
             MainWindow.utenteLoggato.UID = (string)obj["uid"];
             foreach (var cookie in request.CookieContainer.GetCookies(new Uri("http://localhost/hackerinsidenotes/Backend/srv_controlloLogin.php"))) {
                 //Console.WriteLine(cookie.ToString()); // test=testValue
                 MessageBox.Show(cookie.ToString());
             }*/

        }

    }
}
