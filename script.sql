USE [master]
GO
/****** Object:  Database [db_workshop]    Script Date: 12/08/2022 10.15.01 ******/
CREATE DATABASE [db_workshop]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_workshop', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_workshop.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'db_workshop_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_workshop_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [db_workshop] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [db_workshop].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [db_workshop] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [db_workshop] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [db_workshop] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [db_workshop] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [db_workshop] SET ARITHABORT OFF 
GO
ALTER DATABASE [db_workshop] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [db_workshop] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [db_workshop] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [db_workshop] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [db_workshop] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [db_workshop] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [db_workshop] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [db_workshop] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [db_workshop] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [db_workshop] SET  DISABLE_BROKER 
GO
ALTER DATABASE [db_workshop] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [db_workshop] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [db_workshop] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [db_workshop] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [db_workshop] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [db_workshop] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [db_workshop] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [db_workshop] SET RECOVERY FULL 
GO
ALTER DATABASE [db_workshop] SET  MULTI_USER 
GO
ALTER DATABASE [db_workshop] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [db_workshop] SET DB_CHAINING OFF 
GO
ALTER DATABASE [db_workshop] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [db_workshop] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [db_workshop] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [db_workshop] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'db_workshop', N'ON'
GO
ALTER DATABASE [db_workshop] SET QUERY_STORE = OFF
GO
USE [db_workshop]
GO
/****** Object:  Table [dbo].[department]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[department](
	[id_department] [int] NOT NULL,
	[department_name] [varchar](50) NOT NULL,
	[section] [varchar](50) NOT NULL,
 CONSTRAINT [PK_department] PRIMARY KEY CLUSTERED 
(
	[id_department] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[material]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[material](
	[id_material] [int] IDENTITY(1,1) NOT NULL,
	[nama_material] [varchar](50) NULL,
	[price_kg] [int] NULL,
	[type] [varchar](50) NULL,
	[massa_jenis] [float] NULL,
 CONSTRAINT [PK_material] PRIMARY KEY CLUSTERED 
(
	[id_material] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[order]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[order](
	[id_order] [int] IDENTITY(1,1) NOT NULL,
	[id_user] [int] NOT NULL,
	[id_department] [int] NOT NULL,
	[id_material] [int] NULL,
	[no_order] [varchar](50) NULL,
	[order_type] [varchar](50) NOT NULL,
	[kategori] [varchar](50) NOT NULL,
	[nama_part] [varchar](50) NOT NULL,
	[jumlah] [varchar](50) NOT NULL,
	[raw_type] [varchar](50) NULL,
	[panjang] [float] NULL,
	[lebar] [float] NULL,
	[diameter] [float] NULL,
	[attachment] [varchar](200) NULL,
	[status_laporan] [varchar](50) NULL,
	[status_pengerjaan] [varchar](50) NOT NULL,
	[jam] [time](7) NULL,
	[tanggal] [date] NULL,
	[approve] [varchar](50) NULL,
	[alasan] [varchar](50) NULL,
	[inhouse] [varchar](50) NULL,
 CONSTRAINT [PK_order] PRIMARY KEY CLUSTERED 
(
	[id_order] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[process]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[process](
	[id_proses] [int] IDENTITY(1,1) NOT NULL,
	[nama_proses] [varchar](50) NULL,
	[harga_perjam] [int] NULL,
	[harga_perjam_manusia] [int] NULL,
	[consumable] [int] NULL,
	[listrik] [int] NULL,
	[harga_mesin] [bigint] NULL,
	[total_cost] [int] NULL,
 CONSTRAINT [PK_process] PRIMARY KEY CLUSTERED 
(
	[id_proses] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[processing]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[processing](
	[id_order] [int] NULL,
	[id_proses] [int] NULL,
	[hour] [float] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user]    Script Date: 12/08/2022 10.15.02 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user](
	[id_user] [int] IDENTITY(1,1) NOT NULL,
	[id_department] [int] NOT NULL,
	[npk] [int] NOT NULL,
	[name] [varchar](50) NOT NULL,
	[username] [varchar](50) NULL,
	[password] [varchar](50) NULL,
	[level] [varchar](50) NULL,
 CONSTRAINT [PK_customer] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[order]  WITH CHECK ADD  CONSTRAINT [FK_order_department] FOREIGN KEY([id_department])
REFERENCES [dbo].[department] ([id_department])
GO
ALTER TABLE [dbo].[order] CHECK CONSTRAINT [FK_order_department]
GO
ALTER TABLE [dbo].[order]  WITH CHECK ADD  CONSTRAINT [FK_order_material] FOREIGN KEY([id_material])
REFERENCES [dbo].[material] ([id_material])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[order] CHECK CONSTRAINT [FK_order_material]
GO
ALTER TABLE [dbo].[order]  WITH CHECK ADD  CONSTRAINT [FK_order_user] FOREIGN KEY([id_user])
REFERENCES [dbo].[user] ([id_user])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[order] CHECK CONSTRAINT [FK_order_user]
GO
ALTER TABLE [dbo].[processing]  WITH CHECK ADD  CONSTRAINT [FK_processing_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[processing] CHECK CONSTRAINT [FK_processing_order]
GO
ALTER TABLE [dbo].[processing]  WITH CHECK ADD  CONSTRAINT [FK_processing_process] FOREIGN KEY([id_proses])
REFERENCES [dbo].[process] ([id_proses])
GO
ALTER TABLE [dbo].[processing] CHECK CONSTRAINT [FK_processing_process]
GO
ALTER TABLE [dbo].[user]  WITH CHECK ADD  CONSTRAINT [FK_user_department] FOREIGN KEY([id_department])
REFERENCES [dbo].[department] ([id_department])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[user] CHECK CONSTRAINT [FK_user_department]
GO
USE [master]
GO
ALTER DATABASE [db_workshop] SET  READ_WRITE 
GO
