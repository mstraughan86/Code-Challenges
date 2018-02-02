<?xml version="1.0" encoding="UTF-8" ?>
<xsl:transform xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="xml" omit-xml-declaration="no" encoding="UTF-8" indent="yes" />
    <xsl:strip-space elements="*"/>

    <xsl:template match="customers">
        <applications>
            <xsl:apply-templates/>
        </applications>
    </xsl:template>

    <xsl:template match="customer">
        <application>
            <first_name><xsl:value-of select="fname"/></first_name>
            <last_name><xsl:value-of select="lname"/></last_name>
            <phone1><xsl:value-of select="substring-before(phone, '-')"/></phone1>
	        <phone2><xsl:value-of select="substring-before(substring-after(phone, '-'), '-')"/></phone2>
	        <phone3><xsl:value-of select="substring-after(substring-after(phone, '-'), '-')"/></phone3>
            <dob><xsl:value-of select="dob_m"/>/<xsl:value-of select="dob_d"/>/<xsl:value-of select="dob_y"/></dob>
            <email_domain><xsl:value-of select="substring-after(email, '@')"/></email_domain>

            <status>
                <xsl:choose>
                    <xsl:when test="active = 'TRUE'">Active</xsl:when>
                    <xsl:when test="active = 'FALSE'">Inactive</xsl:when>
                </xsl:choose>
            </status>
            
            <xsl:choose>
                <xsl:when test="type != ''">
                   <repeat><xsl:value-of select="substring(type, 1, 1)"/></repeat>
                </xsl:when>
            </xsl:choose>
        </application>
    </xsl:template>
    
    <xsl:template match="text()"/>
</xsl:transform>