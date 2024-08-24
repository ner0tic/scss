# organization/serializers.py

from rest_framework import serializers

from .models.organization import Organization


class OrganizationSerializer(serializers.ModelSerializer):
    class Meta:
        model = Organization
        fields = "__all_"
