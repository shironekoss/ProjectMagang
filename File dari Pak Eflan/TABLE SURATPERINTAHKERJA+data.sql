USE [learnGUI]
GO

/****** Object:  Table [dbo].[SURATPERINTAHKERJA]    Script Date: 10/13/2022 10:32:41 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[SURATPERINTAHKERJA](
	[SPK Number] [char](31) NOT NULL,
	[Merk] [char](61) NOT NULL,
	[Type] [char](61) NOT NULL,
	[No Rangka] [char](61) NOT NULL,
	[No Mesin] [char](61) NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

GO
INSERT [dbo].[SURATPERINTAHKERJA] ([SPK Number], [Merk], [Type], [No Rangka], [No Mesin]) VALUES (N'A01JM22                        ', N'MITSUBISHI                                                   ', N'FE71 LONG (NC)                                               ', N'MHMFE71PJMJ 000121                                           ', N'4D34T - U46000                                               ')
INSERT [dbo].[SURATPERINTAHKERJA] ([SPK Number], [Merk], [Type], [No Rangka], [No Mesin]) VALUES (N'B11EL22                        ', N'ISUZU                                                        ', N'NLR55BLX                                                     ', N'MHCNLR55HNJ 093405                                           ', N'M093405                                                      ')
