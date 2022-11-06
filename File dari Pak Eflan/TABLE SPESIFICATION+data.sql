USE [learnGUI]
GO

/****** Object:  Table [dbo].[SPECIFICATION]    Script Date: 10/13/2022 10:32:29 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[SPECIFICATION](
	[Type ID] [char](15) NOT NULL,
	[SPK Number] [varchar](31) NOT NULL,
	[Bagian] [varchar](8) NOT NULL,
	[CODE] [char](101) NULL,
	[User Defined] [varchar](31) NULL,
	[User Defined Description] [varchar](121) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

GO
INSERT [dbo].[SPECIFICATION] ([Type ID], [SPK Number], [Bagian], [CODE], [User Defined], [User Defined Description]) VALUES (N'INVOICE MB     ', N'B11EL22                        ', N'Main', N'                                                                                                     ', N'LAMPU BELAKANG                 ', N'STOP LAMP MODEL ISUZU D-MAX                                                                                              ')
INSERT [dbo].[SPECIFICATION] ([Type ID], [SPK Number], [Bagian], [CODE], [User Defined], [User Defined Description]) VALUES (N'INVOICE MB     ', N'B11EL22                        ', N'Main', N'                                                                                                     ', N'BANGKU, (WARNA)                ', N'                                                                                                                         ')
