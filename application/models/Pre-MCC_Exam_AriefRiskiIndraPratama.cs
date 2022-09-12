using System;	
using System.Collections.Generic;
namespace Simple_Atm_Application {

public interface IAtmMenu
    {
        void show();
    }

public abstract class Tombol : IAtmMenu
    {
        public abstract void show();
        protected abstract void printMenu();
        protected string pilihMenu()
        {
            return Console.ReadLine();
        }
        protected abstract void inputan(String pilihan);
        protected void wait()
        {
            Console.Write("\nTekan ENTER untuk melanjutkan . . .");
            Console.ReadLine();
        }
    }


public class MenuUtama : Tombol
    {
        private IAtmMenu menu1;
        private IAtmMenu menu2;
        private IAtmMenu menu3;
        private IAtmMenu menu4;
        private IAtmMenu menu5;
        public static int saldo;
		public static int rekening =0;
        public static Dictionary<int, int> rekenings = new Dictionary<int, int>();
        public static int counter = 0;
        public static int counterb = 0;
        private bool loopMenu = true;
        
		
        public MenuUtama(IAtmMenu m1,IAtmMenu m2,IAtmMenu m3,IAtmMenu m4,IAtmMenu m5, int saldo_awal)
        {
            this.menu1 = m1;
            this.menu2 = m2;
            this.menu3 = m3;
            this.menu4 = m4;
			this.menu5 = m5;
            saldo= saldo_awal;   
        }



        protected override void printMenu()
        {
            Console.Clear();
            Console.WriteLine("===== Bank M =====");
			Console.WriteLine("=======MENU=========");
			Console.WriteLine("Pilih transaksi Anda");
			Console.WriteLine("1. Cek Saldo");
			Console.WriteLine("2. Tarik Saldo");
			Console.WriteLine("3. Setor Tunai");
			Console.WriteLine("4. Transfer Uang");
			Console.WriteLine("5. Riwayat Trasnfer Uang");
			Console.WriteLine("6. Keluar");
            Console.Write("\nPilihan Anda: ");
            counter = 0;
            counterb = 0;
        }

        protected override void inputan(String pilihan)
        {
            switch (pilihan)
            {
                case "1":
                    menu1.show();
                    break;
                case "2":
                    menu2.show();
                    break;
                case "3":
                    menu3.show();
                    break;  
				case "4":
                    menu4.show();
                    break;
				case "5":
                    menu5.show();
                    break; 	
				case "6":
                default:
                    loopMenu = false;
                    break;
            }
        }

        public override void show()
        {
            while (loopMenu)
            {
                printMenu();
                inputan(pilihMenu());
            }
        }

    }

    class Menu1 : Tombol
    {
        protected override void printMenu()
        {
			Console.Clear();
            Console.WriteLine("Saldo Saat Ini Adalah " + MenuUtama.saldo);
			wait();
			
        }

        protected override void inputan(string pilihan)
        {
            inputan(pilihMenu());
        }

       
        public override void show()
        {
            printMenu();
        }

    }

    class Menu2 : Tombol
    {
        protected override void printMenu()
        {
			Console.Write("\nMasukan jumlah yang ingin di Tarik: ");
			
        }

        protected override void inputan(string pilihan)
        {
            
            if(int.Parse(pilihan) > MenuUtama.saldo){
                Console.Write("\nMaaf Saldo Tidak Cukup !");
            }else{
                MenuUtama.saldo -= int.Parse(pilihan);
				 Console.Write("\nTarik Dana Sukses sebesar " +int.Parse(pilihan)+" !" );
            }

            wait();
        }

       
        public override void show()
        {
            printMenu();
			inputan(pilihMenu());
        }

    }

     class Menu3 : Tombol
    {
        protected override void printMenu()
        {
			Console.Write("\nMasukan jumlah setor tunai: ");
			
        }

        protected override void inputan(string pilihan)
        {
            
            MenuUtama.saldo += int.Parse(pilihan);
            Console.Write("\nSetor tunai Sukses sebesar " +int.Parse(pilihan)+" !" );
            
            wait();
        }

       
        public override void show()
        {
            printMenu();
			inputan(pilihMenu());
        }

    }

    class Menu4 : Tombol
    {
        protected override void printMenu()
        {
            if(MenuUtama.counter==0){
			Console.Write("\nMasukan Rekening Transfer: ");
            }else{
                Console.Write("\nMasukan Uang Transfer: ");
            }
            MenuUtama.counter++;
        }

       
        protected override void inputan(string pilihan)
        {
            if(MenuUtama.counterb==0){
            Console.Write("\nKirim uang ke rekening " +int.Parse(pilihan)+" " );
			MenuUtama.rekening = int.Parse(pilihan);

            }else{
                if(int.Parse(pilihan)>MenuUtama.saldo){
                     Console.Write("\nTransfer Gagal");
                }else{
					MenuUtama.rekenings.Add(MenuUtama.rekening,int.Parse(pilihan));
                    MenuUtama.saldo-=int.Parse(pilihan);
                    Console.Write("\nTransfer Sukses");
                }
                wait();
            }
             MenuUtama.counterb++;
        }
       
        public override void show()
        {
            printMenu();
			inputan(pilihMenu());
            printMenu();
			inputan(pilihMenu());
        }
    }

    class Menu5 : Tombol
    {
        protected override void printMenu() {}
        protected override void inputan(string pilihan){}
        public override void show()
        {
			if(MenuUtama.rekenings.Count==0){
				Console.WriteLine("Belum pernah kirim uang");
			}else{
				foreach (KeyValuePair<int, int> rekening in MenuUtama.rekenings){		
					Console.WriteLine("Riwayat Kirim uang ke " + rekening.Key + " Sebesar  " + rekening.Value);
				}
            }
            wait();
        }

    }

   

    public class Program
    {
        public static void Main(string[] args)
        {
            IAtmMenu menu1 = new Menu1();
            IAtmMenu menu2 = new Menu2();
            IAtmMenu menu3 = new Menu3();
            IAtmMenu menu4 = new Menu4();
			IAtmMenu menu5 = new Menu5();
            IAtmMenu screen = new MenuUtama(menu1,menu2,menu3,menu4,menu5,100000);
            //Saldo Awal Rp.100.000
            screen.show();
        }
    }
}
