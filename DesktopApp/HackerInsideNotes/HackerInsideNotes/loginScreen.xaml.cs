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

        }

        private void Button_Click(object sender, RoutedEventArgs e) {

            MainWindow.utenteLoggato.login(txtbUsername.Text, txtbPassword.Password.ToString());

            if(MainWindow.utenteLoggato.UID != "-1") {
                Properties.Settings.Default.serverUrl = txtbServer.Text;
                Properties.Settings.Default.Save();
                new MainWindow().Show();
                Close();
            } else {
                MessageBox.Show("Wrong username or password!");
            }

        }

    }
}
