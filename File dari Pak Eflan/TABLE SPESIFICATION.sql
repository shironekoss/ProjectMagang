USE [DATABASENAME]
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


