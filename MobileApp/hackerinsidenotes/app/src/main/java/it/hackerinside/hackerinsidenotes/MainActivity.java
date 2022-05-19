package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import java.net.CookieHandler;

public class MainActivity extends AppCompatActivity {
    EditText txtbUsername,txtbServer;
    EditText txtbPassword;
    Button btnLogin;
   public static User utenteLoggato;
    public static final String ogg = "com.example.myfirstapp.MESSAGE";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        txtbPassword = findViewById(R.id.txtbPassword);
        txtbUsername = findViewById(R.id.txtbUsername);
        txtbServer = findViewById(R.id.txtbServerURL);
        btnLogin = findViewById(R.id.btnLogin);
        utenteLoggato = new User();
        CookieHandler.setDefault(utenteLoggato.cookieContainer);

        /*btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try{
                    utenteLoggato.UID = utenteLoggato.login("admin","admin");
                    if(utenteLoggato.UID != "-1"){
                        Intent intent = new Intent(this, Notepad.class);

                        intent.putExtra("UTENTELOGGATO", utenteLoggato);
                        startActivity(intent);
                    }
                }catch(Exception e){

                }

            }
        });*/

    }

    public void btnloginClick(View v){
        try{
            utenteLoggato.UID = utenteLoggato.login("admin","admin");
            if(utenteLoggato.UID != "-1"){
                Log.d("uid",utenteLoggato.UID);
                Intent intent = new Intent(MainActivity.this, it.hackerinside.hackerinsidenotes.Notepad.class);

                intent.putExtra("UTENTELOGGATO", utenteLoggato);
                startActivity(intent);
           }
        }catch(Exception e){

        }
    }
}