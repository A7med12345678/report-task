USE [master]
GO
/****** Object:  Database [report]    Script Date: 4/12/2023 4:57:23 AM ******/
CREATE DATABASE [report]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'report', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\report.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'report_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\report_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [report] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [report].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [report] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [report] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [report] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [report] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [report] SET ARITHABORT OFF 
GO
ALTER DATABASE [report] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [report] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [report] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [report] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [report] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [report] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [report] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [report] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [report] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [report] SET  DISABLE_BROKER 
GO
ALTER DATABASE [report] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [report] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [report] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [report] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [report] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [report] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [report] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [report] SET RECOVERY FULL 
GO
ALTER DATABASE [report] SET  MULTI_USER 
GO
ALTER DATABASE [report] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [report] SET DB_CHAINING OFF 
GO
ALTER DATABASE [report] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [report] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [report] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [report] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'report', N'ON'
GO
ALTER DATABASE [report] SET QUERY_STORE = OFF
GO
USE [report]
GO
/****** Object:  Table [dbo].[report]    Script Date: 4/12/2023 4:57:24 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[report](
	[r_id] [int] NULL,
	[worker1_sta] [nvarchar](20) NULL,
	[worker2_sta] [nvarchar](20) NULL,
	[r_done] [nvarchar](10) NULL,
	[submit_time] [smalldatetime] NULL,
	[r_content] [nvarchar](1000) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[worker]    Script Date: 4/12/2023 4:57:24 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[worker](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[e_name] [nvarchar](25) NOT NULL,
	[e_status] [int] NOT NULL,
	[e_done] [int] NOT NULL,
	[e_user] [nvarchar](10) NULL,
	[e_pass] [nvarchar](10) NULL,
 CONSTRAINT [PK_worker] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-30T05:47:00' AS SmallDateTime), N'test2')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'still work', CAST(N'2023-03-30T05:48:00' AS SmallDateTime), N'test')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-23T12:44:00' AS SmallDateTime), N'test')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'done', CAST(N'2023-03-23T12:44:00' AS SmallDateTime), N'test2')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-23T12:44:00' AS SmallDateTime), N'test3')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'still work', CAST(N'2023-03-23T12:44:00' AS SmallDateTime), N'test4')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-23T12:52:00' AS SmallDateTime), N'test')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'done', CAST(N'2023-03-23T12:52:00' AS SmallDateTime), N'test2')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-30T05:54:00' AS SmallDateTime), N'ahmed')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'done', CAST(N'2023-03-30T06:03:00' AS SmallDateTime), N'hello')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'ahmed', N'nour', N'done', CAST(N'2023-03-30T06:03:00' AS SmallDateTime), N'hello')
INSERT [dbo].[report] ([r_id], [worker1_sta], [worker2_sta], [r_done], [submit_time], [r_content]) VALUES (NULL, N'khaled', N'youmna', N'still work', CAST(N'2023-03-30T06:04:00' AS SmallDateTime), N'df')
GO
SET IDENTITY_INSERT [dbo].[worker] ON 

INSERT [dbo].[worker] ([id], [e_name], [e_status], [e_done], [e_user], [e_pass]) VALUES (6, N'ahmed', 0, 10, N'ahmed_1', N'12345')
INSERT [dbo].[worker] ([id], [e_name], [e_status], [e_done], [e_user], [e_pass]) VALUES (7, N'youmna', 0, 11, N'youmna_1', N'12345')
INSERT [dbo].[worker] ([id], [e_name], [e_status], [e_done], [e_user], [e_pass]) VALUES (8, N'khaled', 0, 11, N'khaled_1', N'12345')
INSERT [dbo].[worker] ([id], [e_name], [e_status], [e_done], [e_user], [e_pass]) VALUES (9, N'nour', 0, 10, N'nour_1', N'12345')
SET IDENTITY_INSERT [dbo].[worker] OFF
GO
USE [master]
GO
ALTER DATABASE [report] SET  READ_WRITE 
GO
