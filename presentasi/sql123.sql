USE [master]
GO
/****** Object:  Database [db_testing]    Script Date: 16/09/2022 12.33.20 ******/
CREATE DATABASE [db_testing]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_testing', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_testing.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'db_testing_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_testing_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [db_testing] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [db_testing].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [db_testing] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [db_testing] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [db_testing] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [db_testing] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [db_testing] SET ARITHABORT OFF 
GO
ALTER DATABASE [db_testing] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [db_testing] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [db_testing] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [db_testing] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [db_testing] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [db_testing] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [db_testing] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [db_testing] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [db_testing] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [db_testing] SET  DISABLE_BROKER 
GO
ALTER DATABASE [db_testing] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [db_testing] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [db_testing] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [db_testing] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [db_testing] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [db_testing] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [db_testing] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [db_testing] SET RECOVERY FULL 
GO
ALTER DATABASE [db_testing] SET  MULTI_USER 
GO
ALTER DATABASE [db_testing] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [db_testing] SET DB_CHAINING OFF 
GO
ALTER DATABASE [db_testing] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [db_testing] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [db_testing] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [db_testing] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'db_testing', N'ON'
GO
ALTER DATABASE [db_testing] SET QUERY_STORE = OFF
GO
USE [db_testing]
GO
/****** Object:  Table [dbo].[approval]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[approval](
	[id_order] [varchar](200) NOT NULL,
	[id_user] [int] NOT NULL,
	[status_approval_1] [varchar](max) NULL,
	[alasan] [varchar](max) NULL,
	[tanggal] [datetime] NULL,
	[jenis_approval] [varchar](50) NULL,
	[approve1] [varchar](50) NULL,
	[approve2] [varchar](50) NULL,
	[approve3] [varchar](50) NULL,
	[approve4] [varchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[approval_final]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[approval_final](
	[id_order] [varchar](200) NOT NULL,
	[id_user] [int] NOT NULL,
	[status_approval] [varchar](max) NULL,
	[alasan_3] [varchar](max) NULL,
	[tanggal] [datetime] NULL,
	[tanggal_2] [datetime] NULL,
	[jenis_approval_1] [varchar](50) NULL,
	[jenis_approval_2] [varchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[approval_pic_workshop]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[approval_pic_workshop](
	[id_order] [varchar](200) NOT NULL,
	[id_user] [int] NOT NULL,
	[status_approval_2] [varchar](max) NULL,
	[alasan_2] [varchar](max) NULL,
	[tanggal] [datetime] NULL,
	[jenis_approval] [varchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[department]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[department](
	[id_department] [int] IDENTITY(1,1) NOT NULL,
	[department_name] [varchar](50) NOT NULL,
 CONSTRAINT [PK_department] PRIMARY KEY CLUSTERED 
(
	[id_department] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_actual_routing]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_actual_routing](
	[id_order] [varchar](200) NOT NULL,
	[total_cost_process] [float] NULL,
	[total_all] [float] NULL,
	[total_hour] [float] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_estimate_routing]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_estimate_routing](
	[id_order] [varchar](200) NOT NULL,
	[total_cost_process] [float] NULL,
	[total_cost_material] [float] NULL,
	[total_all] [float] NULL,
	[total_hour] [float] NULL,
	[tempat_pembuatan] [varchar](50) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_raw_type]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_raw_type](
	[id_order] [varchar](200) NOT NULL,
	[id_raw_type] [int] NULL,
	[panjang] [int] NULL,
	[lebar] [int] NULL,
	[diameter] [int] NULL,
	[volume] [float] NULL,
	[berat] [float] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[material]    Script Date: 16/09/2022 12.33.20 ******/
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
/****** Object:  Table [dbo].[order]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[order](
	[id_order] [varchar](200) NOT NULL,
	[id_user] [int] NOT NULL,
	[id_department] [int] NOT NULL,
	[id_material] [int] NULL,
	[id_section] [int] NULL,
	[order_type] [varchar](50) NULL,
	[kategori] [varchar](50) NULL,
	[nama_part] [varchar](50) NULL,
	[jumlah] [varchar](50) NULL,
	[attachment] [varchar](max) NULL,
	[status_pengerjaan] [varchar](50) NULL,
	[tanggal] [datetime] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_order] PRIMARY KEY CLUSTERED 
(
	[id_order] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[process]    Script Date: 16/09/2022 12.33.20 ******/
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
/****** Object:  Table [dbo].[raw_type]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[raw_type](
	[id_raw_type] [int] IDENTITY(1,1) NOT NULL,
	[nama_raw_type] [varchar](50) NULL,
 CONSTRAINT [PK_raw_type] PRIMARY KEY CLUSTERED 
(
	[id_raw_type] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[routing_actual]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[routing_actual](
	[id_order] [varchar](200) NULL,
	[id_proses] [int] NULL,
	[hour] [float] NULL,
	[actual_cost_process] [float] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[routing_plan]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[routing_plan](
	[id_order] [varchar](200) NULL,
	[id_proses] [int] NULL,
	[hour] [float] NULL,
	[estimate_cost_process] [float] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[scheduling]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[scheduling](
	[id_order] [varchar](200) NULL,
	[start_date] [date] NULL,
	[end_date] [date] NULL,
	[total_day] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[section]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[section](
	[id_section] [int] IDENTITY(1,1) NOT NULL,
	[id_department] [int] NOT NULL,
	[section_name] [varchar](max) NOT NULL,
 CONSTRAINT [PK_section] PRIMARY KEY CLUSTERED 
(
	[id_section] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user](
	[id_user] [int] IDENTITY(1,1) NOT NULL,
	[id_department] [int] NULL,
	[id_section] [int] NULL,
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
/****** Object:  Table [dbo].[working_order]    Script Date: 16/09/2022 12.33.20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[working_order](
	[id_order] [varchar](200) NULL,
	[start_working] [date] NULL,
	[end_working] [date] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [IX_detail_estimate_routing]    Script Date: 16/09/2022 12.33.20 ******/
CREATE NONCLUSTERED INDEX [IX_detail_estimate_routing] ON [dbo].[detail_estimate_routing]
(
	[id_order] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [dbo].[order] ADD  CONSTRAINT [DF_order_created_at]  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[approval]  WITH CHECK ADD  CONSTRAINT [FK_approval_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[approval] CHECK CONSTRAINT [FK_approval_order]
GO
ALTER TABLE [dbo].[approval_final]  WITH CHECK ADD  CONSTRAINT [FK_approval_final_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[approval_final] CHECK CONSTRAINT [FK_approval_final_order]
GO
ALTER TABLE [dbo].[approval_final]  WITH CHECK ADD  CONSTRAINT [FK_approval_final_user] FOREIGN KEY([id_user])
REFERENCES [dbo].[user] ([id_user])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[approval_final] CHECK CONSTRAINT [FK_approval_final_user]
GO
ALTER TABLE [dbo].[approval_pic_workshop]  WITH CHECK ADD  CONSTRAINT [FK_approval_pic_workshop_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[approval_pic_workshop] CHECK CONSTRAINT [FK_approval_pic_workshop_order]
GO
ALTER TABLE [dbo].[approval_pic_workshop]  WITH CHECK ADD  CONSTRAINT [FK_approval_pic_workshop_user] FOREIGN KEY([id_user])
REFERENCES [dbo].[user] ([id_user])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[approval_pic_workshop] CHECK CONSTRAINT [FK_approval_pic_workshop_user]
GO
ALTER TABLE [dbo].[detail_actual_routing]  WITH CHECK ADD  CONSTRAINT [FK_detail_actual_routing_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[detail_actual_routing] CHECK CONSTRAINT [FK_detail_actual_routing_order]
GO
ALTER TABLE [dbo].[detail_estimate_routing]  WITH CHECK ADD  CONSTRAINT [FK_detail_estimate_routing_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[detail_estimate_routing] CHECK CONSTRAINT [FK_detail_estimate_routing_order]
GO
ALTER TABLE [dbo].[detail_raw_type]  WITH CHECK ADD  CONSTRAINT [FK_detail_raw_type_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[detail_raw_type] CHECK CONSTRAINT [FK_detail_raw_type_order]
GO
ALTER TABLE [dbo].[detail_raw_type]  WITH CHECK ADD  CONSTRAINT [FK_detail_raw_type_raw_type] FOREIGN KEY([id_raw_type])
REFERENCES [dbo].[raw_type] ([id_raw_type])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[detail_raw_type] CHECK CONSTRAINT [FK_detail_raw_type_raw_type]
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
GO
ALTER TABLE [dbo].[order] CHECK CONSTRAINT [FK_order_user]
GO
ALTER TABLE [dbo].[routing_actual]  WITH CHECK ADD  CONSTRAINT [FK_routing_actual_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[routing_actual] CHECK CONSTRAINT [FK_routing_actual_order]
GO
ALTER TABLE [dbo].[routing_plan]  WITH CHECK ADD  CONSTRAINT [FK_processing_process] FOREIGN KEY([id_proses])
REFERENCES [dbo].[process] ([id_proses])
GO
ALTER TABLE [dbo].[routing_plan] CHECK CONSTRAINT [FK_processing_process]
GO
ALTER TABLE [dbo].[routing_plan]  WITH CHECK ADD  CONSTRAINT [FK_routing_plan_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[routing_plan] CHECK CONSTRAINT [FK_routing_plan_order]
GO
ALTER TABLE [dbo].[scheduling]  WITH CHECK ADD  CONSTRAINT [FK_scheduling_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[scheduling] CHECK CONSTRAINT [FK_scheduling_order]
GO
ALTER TABLE [dbo].[section]  WITH CHECK ADD  CONSTRAINT [FK_section_department] FOREIGN KEY([id_department])
REFERENCES [dbo].[department] ([id_department])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[section] CHECK CONSTRAINT [FK_section_department]
GO
ALTER TABLE [dbo].[user]  WITH CHECK ADD  CONSTRAINT [FK_user_department] FOREIGN KEY([id_department])
REFERENCES [dbo].[department] ([id_department])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[user] CHECK CONSTRAINT [FK_user_department]
GO
ALTER TABLE [dbo].[working_order]  WITH CHECK ADD  CONSTRAINT [FK_working_order_order] FOREIGN KEY([id_order])
REFERENCES [dbo].[order] ([id_order])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[working_order] CHECK CONSTRAINT [FK_working_order_order]
GO
USE [master]
GO
ALTER DATABASE [db_testing] SET  READ_WRITE 
GO
