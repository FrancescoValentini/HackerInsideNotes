using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace HackerInsideNotes {
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window {
        public static User utenteLoggato = new User();

        public MainWindow() {
            InitializeComponent();
            Hide();

            if(utenteLoggato.UID == null) {
                loginScreen window = new loginScreen();
                window.Show();
            } else {
                refreshNotes();
            }






        }
        private void deleteNote_Click(object sender, RoutedEventArgs e) {
            utenteLoggato.deleteNote((listboxNote.SelectedItem as Nota).ID);

            refreshNotes();

        }



        private void listboxNote_SelectionChanged(object sender, SelectionChangedEventArgs e) {
            try {
                Nota selezionata = listboxNote.SelectedItem as Nota;
                if (selezionata != null) {
                    txtbTitolo.Text = selezionata.titolo;
                    txtbNota.Document.Blocks.Clear();
                    txtbNota.Document.Blocks.Add(new Paragraph(new Run(selezionata.nota)));
                }

            } catch (Exception ex) {
            }

        }

        private void Window_Closing(object sender, System.ComponentModel.CancelEventArgs e) {
            
        }

        private void Window_Closed(object sender, EventArgs e) {

        }
        private void refreshNotes() {
            listboxNote.Items.Clear();
            List<Nota> note = utenteLoggato.getNotes();
            foreach (Nota nota in note) {
                listboxNote.Items.Add(nota);
            }
        }

        private void btnAddNote_Click(object sender, RoutedEventArgs e) {
            utenteLoggato.addNote(txtbTitolo.Text, new TextRange(txtbNota.Document.ContentStart, txtbNota.Document.ContentEnd).Text);
            refreshNotes();
        }

        private void btnSave_Click(object sender, RoutedEventArgs e) {
            utenteLoggato.editNote((listboxNote.SelectedItem as Nota).ID,txtbTitolo.Text, new TextRange(txtbNota.Document.ContentStart, txtbNota.Document.ContentEnd).Text);
            refreshNotes();
        }
    }
}
