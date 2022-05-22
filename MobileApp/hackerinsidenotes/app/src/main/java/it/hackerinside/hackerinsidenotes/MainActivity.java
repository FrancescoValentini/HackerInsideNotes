package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import org.json.JSONObject;

import java.net.CookieHandler;
import java.net.CookieManager;
import java.net.CookiePolicy;
import java.net.HttpCookie;
import java.net.URI;

public class MainActivity extends AppCompatActivity {
    EditText txtbUsername,txtbServer;
    EditText txtbPassword;
    Button btnLogin;
   public static User utenteLoggato;
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

    }

    public void btnloginClick(View v){
        try{
            utenteLoggato.UID = utenteLoggato.login("admin","admin");

            if(utenteLoggato.UID != "-1"){
                Log.d("uid",utenteLoggato.UID);
               Intent intent = new Intent(MainActivity.this, it.hackerinside.hackerinsidenotes.Notepad.class);


                intent.putExtra("username","admin");
                intent.putExtra("password","admin");



               startActivity(intent);
           }
        }catch(Exception e){

        }
    }
}